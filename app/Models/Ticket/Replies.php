<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    protected $table = 'ticket_replies';

    protected $fillable = [
        'ticket_id',
        'parent_id',
        'user_id',
        'content',
        'is_new',
        'is_favorite',
        'is_important',
    ];

    protected $casts = [
      'is_new'          => 'boolean',
      'is_favorite'     => 'boolean',
      'is_important'    => 'boolean',
    ];
}
