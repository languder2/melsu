<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        'alt',
        'filename',
        'filetype',
        'type',
        'show',
        'order',
        'relation_id',
        'relation_type',
    ];

    public static function FormRules($id): array
    {
        return [
            'name' => 'required',
            'alt' => '',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200',
            'gallery_code'  => '',
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

            $file->storeAs("$path/$this->filename", 'image.svg');
            $this->save();

            return;
        }

        $this->filetype = 'webp';

        $this->reference_id = null;

        if(!$this->name)
            $this->name = $this->relation()->name ?? $this->relation()->title ?? 'empty';

        $this->save();

        if($this->type !== 'ico'){
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            $width  = ($image->width()  > $image->height()) ?600:600*$image->width()/$image->height();
            $height = ($image->height() > $image->width())  ?600:600*$image->height()/$image->width();

            Storage::put("$path/$this->filename/image.webp",(string)$image->toWebp(90));
            Storage::put("$path/{$this->filename}/thumbnail.webp",(string)$image->resize($width,$height)->toWebp(90));
        }
    }

    public static function getPath(?string $model = null):string
    {
        return match($model){
            'App\Models\Division\Division'      => "images/divisions/",
            'App\Models\Education\Faculty'      => "images/faculty/",
            'App\Models\Education\Departments'  => "images/departments/",
            'App\Models\Education\Labs'         => "images/labs/",
            'App\Models\News\News'              => 'images/news/',
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

        $record = $this->reference??$this;

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
        $path = collect(explode('/', $path));

        $this->reference_id = Image::where('filename', $path->take(-2)->first())->pluck('id')->first();

        if(!$this->name)
            $this->name = $this->relation()->name ?? $this->relation()->title ?? 'empty';

        $this->save();
    }
    public static function getReference(string $path):?int
    {
        $path = collect(explode('/', $path));

        return Image::where('filename', $path->take(-2)->first())->pluck('id')->first();
    }

    public function getOrderAttribute($order):int|null
    {
        return ($order === 10000) ? $order : null;
    }

    public static function placeholder():string
    {
        return Storage::url('images/placeholder.png');
    }

}
