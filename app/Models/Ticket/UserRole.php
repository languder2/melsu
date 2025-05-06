<?php

namespace App\Models\Ticket;

use App\Enums\TicketRoles;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_user_roles';

    protected $fillable = [
        'user_id',
        'is_responsible',
        'role',
        'post',
    ];
    protected $casts = [
        'role'              => TicketRoles::class,
        'is_responsible'    => 'boolean',
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
