<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    protected $table = 'education_places';

    protected $fillable = [
        'type',
        'count',
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
