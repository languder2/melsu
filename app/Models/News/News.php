<?php

namespace App\Models\News;

use App\Models\Gallery\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends NewsCategory
{
    use SoftDeletes;

    public static int $adminPerPage = 20;

    public static $FormRules = [
        'category' => 'required',
        'title' => 'required',
        'short' => '',
        'full' => '',
        'news' => '',
        'author' => '',
        'sort' => '',
        'publication_at' => '',
        'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'preview'   => 'nullable|string',
    ];

    public static $FormMessage = [
        'category' => 'Выберите категорию',
        'title' => 'Укажите заголовок',
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

    public static function getList(?int $cid = null): object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*', 'news_categories.name as category_name')
            ->orderBy('news.publication_at', 'desc');

        if (!is_null($cid))
            $list->where('news.category', $cid);

        return $list->get();
    }

    public static function getPaginate(?int $cid = null): object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*', 'news_categories.name as category_name')
            ->orderBy('news.publication_at', 'desc');

        if (!is_null($cid))
            $list->where('news.category', $cid);

        return $list->paginate(self::$adminPerPage);
    }

    public function getPublicationAtAttribute($value)
    {
        return self::$month[Carbon::createFromDate($value)->format('n') - 1]
            . Carbon::createFromDate($value)->format(' j, Y');
    }

    public function getPhotoAttribute()
    {
        return asset('images/news/600x600_' . $this->image . '.jpg');
    }

    public function getLinkAttribute()
    {
        return url(route('news:show', [$this->id]));
    }

    public function getLinkAllAttribute()
    {
        return url(route('news:show:all'));
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category', 'id');
    }

    public function getImageAttribute($image)
    {
        return $image?asset("images/news/600x600_$image.jpg"):null;
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
