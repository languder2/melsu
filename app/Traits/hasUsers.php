<?php

namespace App\Traits;

use App\Enums\Entities;
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

    public function getUserAccessCabinetListAttribute():string
    {
        return route('user-access.cabinet.list', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function getUserAccessCabinetSaveAttribute():string
    {
        return route('user-access.cabinet.save', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);

    }
}
