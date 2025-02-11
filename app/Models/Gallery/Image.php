<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Image as InterventionImage;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'gallery_images';

    protected $fillable = [
        'id',
        'name',
        'alt',
        'filename',
        'show',
        'order',
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

    public static function test()
    {
        return 'test';
    }
}
