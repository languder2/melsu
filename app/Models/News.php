<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
class News extends NewsCategory
{
    use SoftDeletes;

    protected $table = 'news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'category',
        'title',
        'short',
        'full',
        'news',
        'image',
        'author',
        'publication_at',
        'deleted_at',
    ];

    public static $FormRules = [
        'id'                => '',
        'category'          => 'required',
        'title'             => 'required',
        'short'             => '',
        'full'              => '',
        'news'              => '',
        'image'             => '',
        'author'            => '',
        'sort'              => '',
        'publication_at'    => '',
    ];
    public static $FormMessage = [
        'category'          => 'Выберите категорию',
        'title'             => 'Укажите заголовок',
    ];

    public static function getList(?int $cid = null):object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*','news_categories.name as group_name')
            ->orderBy('news.publication_at','desc')
        ;

        if(!is_null($cid))
            $list->where('news.category', $cid);


        return $list->get();
    }

}
