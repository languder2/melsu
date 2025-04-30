<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'meta';

    protected $fillable = [
        'type',
        'content'
    ];
}
