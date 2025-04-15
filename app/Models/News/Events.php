<?php

namespace App\Models\News;

use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends NewsCategory
{
    use SoftDeletes;

    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'type',
        'title',
        'short',
        'full',
        'news',
        'image',
        'author',
        'published_at',
        'deleted_at',
    ];
    public static int $adminPerPage = 20;
    public static function FormRules():array
    {
        return [
            'type' => 'required',
            'title' => 'required',
            'short' => '',
            'full' => '',
            'news' => '',
            'author' => '',
            'sort' => '',
            'published_at' => '',
        ];
    }

    public static function FormMessage():array
    {
        return[
            'type' => 'Укажите тип',
            'title' => 'Укажите заголовок',
        ];
    }

    public function preview(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'preview');

        if(!$image->count())
            $image->create([
                'type'      => 'preview',
                'name'      => 'preview',
            ])->save();

        return $image;

    }

}
