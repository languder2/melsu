<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\User;
use Couchbase\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     */
    public function manage(User $user, User $model): bool
    {
        return
            $user->role->level() > $model->role->level()
            || $user->id === $model->id
            || $user->role === UserRoles::Super;
    }


}
