<?php

namespace App\Models\Global;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Options extends Model
{
    use SoftDeletes;

    protected $table = 'options';

    protected $fillable = [
        'code',
        'property',
    ];
    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

}
