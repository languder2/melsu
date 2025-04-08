<?php

namespace App\Models\Cabinet;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'author_id',
        'title',
        'comment',
        'content',


    ];
}
