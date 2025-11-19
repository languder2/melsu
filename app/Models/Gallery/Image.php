<?php

namespace App\Models\Gallery;

use App\Models\Services\Log;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'gallery_images';

    protected $fillable = [
        'id',
        'reference_id',
        'name',
        'path',
        'alt',
        'filename',
        'filetype',
        'type',
        'show',
        'order',
    ];

    protected $casts    = [
        'show'  => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            if(empty($item->name))
                $item->name = now()->format('d-m-Y H-i-s');
        });

        static::deleting(function ($item) {
        });
    }
    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'alt' => '',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200',
            'gallery_code'  => '',
            'order'  => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name'          => 'Укажите название',
            'image.mimes'   => 'Не верный формат изображения',
            'image.max'     => 'Размер изображения превышает лимит в 50MB',
        ];
    }
    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['order'] = $attributes['order'] ?? 1000;
        }

        return parent::fill($attributes);
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function saveImage(UploadedFile $file):void
    {

        $path = self::getPath($this->relation_type);

        $this->filename = substr($file->hashName(),0,strpos($file->hashName(),'.'));

        if($file->extension() === 'svg'){
            $this->filetype = 'svg';
            $this->path     = "$path/$this->filename/image.svg";

            $file->storeAs("$path/$this->filename", 'image.svg');
            $this->save();

            return;
        }

        $this->filetype = 'webp';

        $this->reference_id = null;

        if(!$this->name)
            $this->name = $this->relation()->name ?? $this->relation()->title ?? 'empty';

        $this->save();

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        if($this->type !== 'ico'){
            $width  = ($image->width()  > $image->height()) ?2000:2000*$image->width()/$image->height();
            $height = ($image->height() > $image->width())  ?2000:2000*$image->height()/$image->width();

            Storage::put("$path/{$this->filename}/thumbnail.webp",(string)$image->resize($width,$height)->toWebp(90));
        }

        $this->path     = "$path/$this->filename/image.webp";
        $this->save();

        Storage::put("$path/$this->filename/image.webp",(string)$image->toWebp(90));
    }

    public static function getPath(?string $model = null):string
    {
        return match($model){
            'App\Models\Division\Division'      => "images/divisions/",
            'App\Models\Education\Faculty'      => "images/faculty/",
            'App\Models\Education\Departments'  => "images/departments/",
            'App\Models\Education\Labs'         => "images/labs/",
            'App\Models\News\News' => 'images/news/',
            'App\Models\Gallery\Gallery'        => 'images/gallery/',
            'App\Models\Staff\Staff'            => 'images/staffs/',
            'App\Models\Department\Group'       => 'images/department/group/',
            'App\Models\Department\Department'  => 'images/department/department/',
            'App\Models\Menu\Item'              => 'images/menu/item/',
            'App\Models\Minor\RegimentMember'   => 'images/regiments/',
            'App\Models\News\RelationNews'      => 'images/relation-news/',
            default                             => 'images/uploads/',
        };
    }
    public function getSrcAttribute():string|null
    {
        $record = $this->reference??$this;

        $path = self::getPath($record->relation_type);

        $path .= $record->filename;

        $filepath=  "$path/image.{$record->filetype}";

        return Storage::exists($filepath)?Storage::url($filepath):Storage::url('images/placeholder.png');
    }

    public function getImageAttribute():string|null
    {
        $record = $this->reference ?? $this;
        $path = self::getPath($record->relation_type);
        $path .= $record->filename;
        $filepath=  "$path/image.{$record->filetype}";

        return Storage::exists($filepath) ? Storage::url($filepath) : Storage::url('images/placeholder.png');
    }

    public function getThumbnailAttribute():string|null
    {

        $record = $this->reference ?? $this;

        $path = self::getPath($record->relation_type);

        $path .= $record->filename;

        $filepath=  ($record->filetype === 'svg')?"$path/image.svg":"$path/thumbnail.webp";

        return Storage::exists($filepath)?Storage::url($filepath):Storage::url('images/placeholder.png');

    }

    public function getPreviewAttribute():string|null
    {

        $record = $this->reference??$this;

        $path = self::getPath($record->relation_type);

        $path .= $record->filename;

        $filepath=  ($record->filetype === 'svg')?"$path/image.svg":"$path/thumbnail.webp";

        return Storage::exists($filepath)?Storage::url($filepath):Storage::url('images/placeholder.png');

    }

    public function getDetailsAttribute():object|null|string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read(public_path($this->src));
        return (object)[
            'width' => $image->width(),
            'height' => $image->height(),
        ];

    }
    public function getOrientalAttribute():string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read(public_path($this->src));
        return ($image->width()>$image->height())?"horizontal":"vertical";

    }

    public function reference(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'reference_id', 'id');
    }

    public function getReferenceID(string $path):void
    {

        $path = explode('/', $path);

        unset($path[count($path)-1]);
        unset($path[0]);
        unset($path[1]);
        unset($path[2]);
        unset($path[3]);
        unset($path[4]);
        unset($path[5]);

        $path = implode("/", $path);;

        $id = Image::where('filename', $path)->pluck('id')->first();

        if($id)
            $this->reference_id = $id;

        if(!$this->name)
            $this->name = $this->relation()->name ?? $this->relation()->title ?? 'empty';

        $this->save();
    }
    public static function getIdFromUrl(string $url):?int
    {
        $path = collect(explode('/', $url));

        dd($path);
        $parsed = parse_url($url);
        $relativePath = $parsed['path'] . (isset($parsed['query']) ? '?' . $parsed['query'] : '');
        $id = Image::where('filename', $path->take(-2)->first())->pluck('id')->first();

        return  $id;
    }
    public static function getReference(string $path):?int
    {
        $path = collect(explode('/', $path));

        return Image::where('filename', $path->take(-2)->first())->pluck('id')->first();
    }

    public function getOrderAttribute($value):int|null
    {
        return ($value < 10000 && $value > 0) ? $value : null;
    }

    public static function placeholder():string
    {
        return Storage::url('images/placeholder.png');
    }
    public function includeSave(?UploadedFile $image = null,?string $preview = null):void
    {

        if($image){
            $this->saveImage($image);
            Log::withOrigin($this->relation,$this);
        }
        elseif($preview){
            $this->getReferenceID($preview);
            Log::withOrigin($this->relation,$this);
        }
        else{
            $this->delete();
            if($this->exists)
                Log::add($this,'delete');
        }
    }


    public static function upload(UploadedFile $file, ?model $model = null): Image
    {

        $id = Image::max('id') + 1;

        $path = self::getPath(get_class($model));

        $image = new Image([
            'name'      => "{$model->name}",
            'filetype'  => 'webp',
            'filename'  => "{$model->id}/{$id}",
            'type'      => 'image',
            'path'      => "$path{$model->id}/{$id}/image.webp",
        ]);

        $image->relation()->associate($model)->save();

        $manager = new ImageManager(new Driver());
        $file = $manager->read($file);

        $width  = ($file->width()  > $file->height()) ?600:600*$file->width()/$file->height();
        $height = ($file->height() > $file->width())  ?600:600*$file->height()/$file->width();

        Storage::put("$path/$image->filename/image.webp",(string)$file->toWebp(90));
        Storage::put("$path/{$image->filename}/thumbnail.webp",(string)$file->resize($width,$height)->toWebp(90));

        return $image;
    }

    /* Links */

    public function getEditAttribute():string
    {
        return  route('admin:image:form', $this);
    }
    public function getApiToggleShowAttribute():string
    {
        return  route('image:api:toggle-show', $this);
    }

    public function getApiDeleteAttribute():string
    {
        return  route('image:api:delete', $this);
    }



    public function isSVG(): bool
    {
        return pathinfo($this->path)['extension'] !== 'svg';
    }

    public function getContentAttribute():?string
    {
            return $this->path ? Storage::get($this->path) : null;
    }

    public static function saveUploadFile(UploadedFile $file, $quality = 95, $scaleW = 1920, $scaleH = 1080): string
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file)
            ->scale($scaleW, $scaleH)
            ->toWebp($quality)
        ;

        $fileName = Str::random(20);

        $path = 'images/' .date('Y'). '/' .date('m') .'/'. date('d')
            .'/' .date('H_i_s') . '_' . $fileName.'.webp';

        Storage::put($path, $image);

        return Storage::disk('public')->url($path);
    }

    /* End links */

    public function saveImageAndPath(UploadedFile $file, $scaleW = 1920, $scaleH = 1080): void
    {
        $path = static::saveUploadFile($file, $scaleW, $scaleH);

        $this->fill([
            'path'  => str_replace(url('storage') . '/', '', $path),
            'name'  => '',
        ])->save();
    }
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->path);
    }
}
