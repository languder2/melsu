<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationNews extends Model
{
    use SoftDeletes;

    protected $table = 'relation_news';

    protected $fillable = [
        'title',
        'is_show',
        'published_at',
    ];

    protected $dates = [
        'published_at',
        'deleted_at'
    ];

    public function getIdAttribute($value):int
    {
        return $value ?? microtime(true);

    }

}
