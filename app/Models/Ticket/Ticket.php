<?php

namespace App\Models\Ticket;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'title',
        'comment',
        'content',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
