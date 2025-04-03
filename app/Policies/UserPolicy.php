<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
