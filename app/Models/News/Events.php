<?php

namespace App\Models\News;

use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use App\Traits\hasAuthor;
use App\Traits\hasContents;
use App\Traits\hasImage;
use App\Traits\hasLinks;
use App\Traits\hasMeta;
use App\Traits\hasRelations;
use App\Traits\MagicGet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\News\Category;

class Events extends Model
{
    use SoftDeletes, MagicGet, hasContents, hasLinks, hasMeta, hasImage, hasAuthor, hasRelations;

    protected $table = 'events';

    protected $fillable = [
        'id',
        'title',
        'event_datetime',
        'author_id',
        'category_id',
        'is_show',
        'has_approval'
    ];

    protected $dates = ['event_datetime'];

    protected $casts = [];

    protected $links = [
        'cabinet_list'          => 'events.cabinet.list',
        'cabinet_on_approval'   => 'events.cabinet.onApproval',
        'cabinet_set_filter'    => 'events.cabinet.set-filter',
        'cabinet_form'          => 'events.cabinet.form',
        'cabinet_save'          => 'events.cabinet.save',
        'cabinet_delete'        => 'events.cabinet.delete',
        'show'                  => 'public:event:show',
    ];

    public function validateRules(): array
    {
        return [
            'title' => 'required',
            'event_datetime'    => 'required',
            'category_id'       => 'nullable|exists:event_categories,id',
            'has_approval'      => '',
            'is_show'           => '',
        ];
    }

    public function validateMessages(): array
    {
        return[
            'title'             => 'Укажите заголовок',
            'event_datetime'    => 'Дату мероприятия',
        ];
    }

    public static function FormRules():array
    {
        return [
            'title' => 'required',
            'event_datetime'    => 'required|date_format:Y-m-d\TH:i',
            'category_id'       => 'nullable|exists:event_categories,id',
        ];
    }

    public static function FormMessage():array
    {
        return[
            'title'             => 'Укажите заголовок',
            'event_datetime'    => 'Дату мероприятия',
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
