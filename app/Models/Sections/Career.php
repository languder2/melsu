<?php

namespace App\Models\Sections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $table = 'careers';

    protected $fillable = [
        'name',
        'salary',
        'content',
        'active',
        'sort',
    ];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function relation():MorphTo
    {
        return $this->morphTo();
    }
    public function getSortAttribute(?int $sort): ?int
    {
        return ($sort < 1000) ? $sort :  null ;
    }

    public function setSortAttribute($sort): void
    {
        $this->attributes['sort'] = $sort ?? 1000;
    }

    public static function processing($object,$list):void
    {
        foreach ($list as $id=>$form) {
            if(!$form['name']) continue;

            $item           = self::find($id) ?? new Career();
            $item->fill($form);
            $item->active   = array_key_exists('active',$form);
            $item->relation()->associate($object);
            $item->save();
        }
    }

}
