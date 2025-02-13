<?php

namespace App\Models\Gallery;

use App\Models\Education\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'gallery_images';

    protected $fillable = [
        'id',
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_code'  => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name'          => 'Укажите название',
            'image.mimes'   => 'Не верный формат изображения',
            'image.max'     => 'Размер изображения превышает лимит в 2MB',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function saveImage(UploadedFile $file,string $path = 'images/gallery'):void
    {
        $this->filename = substr($file->hashName(),0,strpos($file->hashName(),'.'));

        if($file->extension() === 'svg'){
            $this->filetype = 'svg';

            $file->storeAs("$path/$this->filename", 'image.svg');
            return;
        }

        $this->filetype = 'webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        $width  = ($image->width()  > $image->height()) ?600:600*$image->width()/$image->height();
        $height = ($image->height() > $image->width())  ?600:600*$image->height()/$image->width();

        Storage::put("$path/$this->filename/image.webp",(string)$image->toWebp(90));
        Storage::put("$path/{$this->filename}/thumbnail.webp",(string)$image->resize($width,$height)->toWebp(90));

    }
    public function getSrcAttribute():string|null
    {
        $record = $this->reference??$this;

        $path = match($record->relation_type){
            'App\Models\Education\Faculty' => 'images/faculty/',
            'App\Models\News' => 'images/news/',
            default => 'images/gallery/',
        };

        $path .= $record->filename;

        $filepath=  "$path/image.{$record->filetype}";

        return Storage::exists($filepath)?Storage::url($filepath):null;
    }

    public function getThumbnailAttribute():string|null
    {
        $record = $this->reference??$this;

        $path = match($record->relation_type){
            'App\Models\Education\Faculty' => "images/faculty/",
            'App\Models\News' => 'images/news/',
            default => 'images/gallery/',
        };

        $path .= $record->filename;

        $filepath=  ($record->filetype === 'svg')?"$path/image.svg":"$path/thumbnail.webp";

        return Storage::exists($filepath)?Storage::url($filepath):null;

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

        $this->save();
    }


}
