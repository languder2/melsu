<?php

namespace App\Models\Global;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Options extends Model
{
    protected $table = 'options';

    protected $fillable = [
        'name',
        'code',
        'property',
    ];
    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

}
