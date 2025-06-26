<?php

namespace App\Models\News;

use App\Models\Gallery\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\News\Category;

class Events extends Model
{
    use SoftDeletes;

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

    public function getLinkAttribute():string
    {
        return route('public:event:show',$this->id);
    }

    public function getEventDatetimeAttribute($value):Carbon
    {
        return $value ? ( $value instanceof Carbon ? $value : Carbon::createFromDate($value)) : now();
    }

    public function FormatedEventDatetime(string $format = "d.m.Y H:i"):string
    {
        return $this->event_datetime->format($format);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
