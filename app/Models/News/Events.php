<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends NewsCategory
{
    use SoftDeletes;

    public static int $adminPerPage = 20;
    public static $FormRules = [
        'type' => 'required',
        'title' => 'required',
        'short' => '',
        'full' => '',
        'news' => '',
        'author' => '',
        'sort' => '',
        'publication_at' => '',
    ];
    public static $FormMessage = [
        'type' => 'Укажите тип',
        'title' => 'Укажите заголовок',
    ];
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
        'publication_at',
        'deleted_at',
    ];

    public static function getList(): object
    {
        return self::orderBy('publication_at', 'desc')->get();
    }

}
