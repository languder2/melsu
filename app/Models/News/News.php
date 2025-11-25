<?php

namespace App\Models\News;

use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use App\Models\Services\Log;
use App\Traits\hasAuthor;
use App\Traits\hasContents;
use App\Traits\hasDivision;
use App\Traits\hasImage;
use App\Traits\hasLinks;
use App\Traits\hasMeta;
use App\Traits\hasNewsCategories;
use App\Traits\hasRelations;
use App\Traits\MagicGet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes, MagicGet, hasContents, hasLinks, hasAuthor, hasDivision, hasMeta, hasImage, hasNewsCategories;

    protected $table = 'news';
    public static int $adminPerPage = 10;
    public string $imagePath = 'images/news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category',
        'title',
        'author_id',
        'published_at',
        'has_approval',
        'is_favorite',
        'is_show',
        'sort',
    ];

    protected array $traitsConfig = [
        'divisions' => [
            'table'         => 'news_relations',
            'foreignKey'    => 'news_id',
        ]
    ];

    public function validateRules(): array
    {
        return [
            'category'      => '',
            'title'         => 'required',
            'is_favorite'   => '',
            'sort'          => '',
            'published_at'  => '',
            'has_approval'  => '',
            'is_show'       => '',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'preview'       => 'nullable|string',
        ];
    }
    public function validateMessage(): array
    {
        return  [
            'category'      => 'Выберите категорию',
            'title'         => 'Укажите заголовок',
        ];
    }

    protected $dates = [
        'published_at',
        'deleted_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function getList(?int $cid = null): object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*', 'news_categories.name as category_name')
            ->orderBy('news.published_at', 'desc');

        if (!is_null($cid))
            $list->where('news.category', $cid);

        return $list->get();
    }

    public static function getPaginate(?int $cid = null): object
    {
        $list = self::join('news_categories', 'news_categories.id', '=', 'news.category')
            ->select('news.*', 'news_categories.name as category_name')
            ->orderBy('news.published_at', 'desc');

        if (!is_null($cid))
            $list->where('news.category', $cid);

        return $list->paginate(self::$adminPerPage);
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
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    public function getImageAttribute($image)
    {
        return $image?asset("images/news/600x600_$image.jpg"):null;
    }

    public function getPreview(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'preview');
    }

    public function getPreviewAttribute(): Image
    {
        return $this->getPreview()->first() ?? (new Image(['type' => 'preview']))->relation()->associate($this);
    }


    protected static function boot()
    {
        parent::boot();

        static::saved(function ($item) {
            Log::add($item);
        });
    }
    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['is_favorite']  = (int) array_key_exists('is_favorite', $attributes);

            if(empty($attributes['is_favorite']))
                $attributes['sort'] = 10000;
            else
                $attributes['sort']     = $attributes['sort'] ?? 10000;
        }

        return parent::fill($attributes);
    }

    public static function getPublicList(): Builder
    {
        return News::
        where('published_at', '<=', Carbon::now())
            ->where('has_approval', true)
            ->orderBy('is_favorite', 'desc')
            ->orderBy('sort')
            ->orderBy('published_at', 'desc')
            ;

    }

    public function getNewsAttribute()
    {
        $value = $this->getContentRecord()->content;

        $pattern = '/image-gallery:([a-zA-Z0-9-_]+):end-gallery/';

        if (preg_match($pattern, $value, $matches)) {

            $code= $matches[1];

            $gallery = Gallery::where('code',$code)->first();

            return str_replace(
                "image-gallery:$code:end-gallery",
                $gallery ? view('gallery.images.public.includes.gallery',compact('gallery')) : null,
                $value
            );
        }
        else
            return $value;
    }

    public function getCabinetFormAttribute(): string
    {
        return route('news.cabinet.form',$this);
    }

    public function getCabinetSaveAttribute(): string
    {
        return route('news.cabinet.save',$this);
    }
    public function getCabinetDeleteAttribute(): string
    {
        return route('news.cabinet.delete',$this);
    }

    public function getContentHTMLAttribute()
    {
        return $this->getContentRecord()->render();
    }

    public function getContentDataAttribute()
    {
        return $this->getContentRecord()->getDataForEditorJS();
    }

    public function getShortHTMLAttribute()
    {
        return $this->getShortRecord()->render();
    }

    public function getShortDataAttribute()
    {
        return $this->getShortRecord()->getDataForEditorJS();
    }


}
