<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model
{
    protected $table = 'contents';

    protected $fillable = [
        'type',
        'content',
    ];
    public function relation():MorphTo
    {
        return $this->morphTo();
    }

}
