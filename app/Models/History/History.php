<?php

namespace App\Models\History;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    protected $table = 'histories';

    protected $fillable = [
        'year',
        'image',
        'description',
        'content',
        'order'
    ];

    public $timestamps = true;
}
