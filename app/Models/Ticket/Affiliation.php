<?php

namespace App\Models\Ticket;

use App\Enums\TicketRoles;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affiliation extends Model
{
    protected $table = 'ticket_affiliation';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'role',
    ];
    protected $casts = [
        'role'          => TicketRoles::class,
    ];
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
