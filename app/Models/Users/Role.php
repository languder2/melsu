<?php

namespace App\Models\Users;

use App\Models\Ticket\UserRole;
use App\Traits\hasRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Role extends Model
{

    protected $table = 'user_roles';

    protected $fillable = [
        'user_id',
        'role'
    ];

    protected $casts = [
        'role'  => UserRole::class
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

}
