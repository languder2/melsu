<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
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
    public static int $adminPerPage = 20;
    public static $FormRules = [
        'category'          => 'required',
        'title'             => 'required',
        'short'             => '',
        'full'              => '',
        'news'              => '',
        'author'            => '',
        'sort'              => '',
        'publication_at'    => '',
    ];
    public static $FormMessage = [
        'category'          => 'Выберите категорию',
        'title'             => 'Укажите заголовок',
    ];

    public static $month = [
        'Янв',
        'Фев',
        'Мар',
        'Апр',
        'Май',
        'Июн',
        'Июл',
        'Авг',
        'Сен',
        'Окт',
        'Ноя',
        'Дек'
    ];


    public function getPublicationAtAttribute($value)
    {
        return self::$month[Carbon::createFromDate($value)->format('n')-1]
        .Carbon::createFromDate($value)->format(' j, Y');
    }

    public static function getList(?int $cid = null):object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*','news_categories.name as category_name')
            ->orderBy('news.publication_at','desc')
        ;

        if(!is_null($cid))
            $list->where('news.category', $cid);

        return $list->get();
    }

    public static function getPaginate(?int $cid = null):object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*','news_categories.name as category_name')
            ->orderBy('news.publication_at','desc')
        ;

        if(!is_null($cid))
            $list->where('news.category', $cid);

        return $list->paginate(self::$adminPerPage);
    }


    public static function getNews(int $id):News|null
    {
        $news = News::find($id);

        if(is_null($news))
            return null;

        $news->publication_at =
            self::$month[Carbon::createFromDate($news->publication_at)->format('n')-1]
            .Carbon::createFromDate($news->publication_at)->format(' j, Y');

        return $news;
    }

}
