<?php

namespace App\Models\Ticket;

use App\Enums\TicketRoles;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    protected $table = 'ticket_user_roles';

    protected $fillable = [
        'user_id',
        'role',
    ];
    protected $casts = [
        'role'      => TicketRoles::class,
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
