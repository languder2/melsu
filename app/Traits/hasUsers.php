<?php

namespace App\Traits;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait hasUsers
{
    public function users(): MorphToMany
    {
        return $this->morphToMany(
            User::class,
            'relation',
            'user_access',
            'relation_id',
            'user_id'
        );
    }
}
