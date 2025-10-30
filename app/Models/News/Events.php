<?php

namespace App\Models\News;

use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use App\Traits\hasContents;
use App\Traits\hasLinks;
use App\Traits\hasMeta;
use App\Traits\MagicGet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\News\Category;

class Events extends Model
{
    use SoftDeletes, MagicGet, hasContents, hasLinks, hasMeta;

    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'type',
        'title',
        'event_datetime',
        'short',
        'full',
        'news',
        'image',
        'author',
        'category_id',
        'published_at',
        'deleted_at',
    ];
    public static int $adminPerPage = 20;

    protected $casts = [
        'event_datetime' => 'datetime',
        'published_at' => 'datetime',
    ];

    public static function FormRules():array
    {
        return [
            'type' => 'required',
            'title' => 'required',
            'event_datetime' => 'nullable|date_format:Y-m-d\TH:i',
            'short' => '',
            'full' => '',
            'news' => '',
            'author' => '',
            'sort' => '',
            'published_at' => '',
            'category_id' => 'required|exists:news_categories,id',
        ];
    }

    public static function FormMessage():array
    {
        return[
            'type' => 'Укажите тип',
            'title' => 'Укажите заголовок',
        ];
    }

    public function getPublishedAtAttribute($value):string
    {
        return Carbon::createFromDate($value)->format('d.m.Y H:i:s');
    }
    public function getPublicDateAttribute($value):string
    {
        return Carbon::createFromDate($value)->format('d.m.Y');

    }
    public function getYearAttribute():string
    {
        return Carbon::createFromDate($this->published_at)->format('Y');
    }
    public function getMonthAttribute():string
    {
        return Carbon::createFromDate($this->published_at)->format('m');
    }
    public function getDayAttribute():string
    {
        return Carbon::createFromDate($this->published_at)->format('d');
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

    /* Links */
    public function getLinkAttribute():string
    {
        return route('public:event:show',$this->id);
    }


    /* Values */
    public function getEventDatetimeAttribute($value): Carbon
    {
        return $value ? ( $value instanceof Carbon ? $value : Carbon::createFromDate($value)) : now();
    }

    public function FormatedEventDatetime(string $format = "d.m.Y H:i"): string
    {
        return $this->event_datetime->format($format);
    }

    /* Relations */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getNewsAttribute($value)
    {
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

}
