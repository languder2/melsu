<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
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
            'code' => "required|unique:education_faculties,code,{$id},id,deleted_at,NULL",
            'description' => '',
            'order' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name' => 'Укажите заголовок',
            'code.required' => 'Код должен быть указан',
            'code.unique' => 'Код должен быть уникальным',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function saveImage(UploadedFile $file):void
    {
        $this->filename = substr($file->hashName(),0,strpos($file->hashName(),'.'));

        if($file->extension() === 'svg'){
            $this->filetype = 'svg';

            $file->storeAs("images/faculty/$this->filename", 'image.svg');
            return;
        }

        $this->filetype = 'webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        $width  = ($image->width()  > $image->height()) ?600:600*$image->width()/$image->height();
        $height = ($image->height() > $image->width())  ?600:600*$image->height()/$image->width();

        Storage::put("images/faculty/$this->filename/image.webp",(string)$image->toWebp(90));
        Storage::put("images/faculty/{$this->filename}/thumbnail.webp",(string)$image->resize($width,$height)->toWebp(90));

    }

    public function getSrcAttribute():string|null
    {
        $path = match($this->relation_type){
            'App\Models\Education\Faculty' => 'images/faculty/',
            default => "",
        };

        $path .= $this->filename;

        $filepath=  "$path/image.{$this->filetype}";

        return Storage::exists($filepath)?Storage::url($filepath):null;
    }

    public function getThumbnailAttribute():string|null
    {

        $path = match($this->relation_type){
            'App\Models\Education\Faculty' => "images/faculty/",
            default => "",
        };

        $path .= $this->filename;

        $filepath=  ($this->filetype === 'svg')?"$path/image.svg":"$path/thumbnail.webp";

        return Storage::exists($filepath)?Storage::url($filepath):null;

    }

}
