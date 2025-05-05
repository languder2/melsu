<?php

namespace App\Models\News;

use App\Models\Gallery\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
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

}
