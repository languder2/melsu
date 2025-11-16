<?php

namespace App\Traits;

use App\Enums\Entities;
use App\Models\Minor\Science;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Route;

trait
hasScience
{
    public function science(): morphMany
    {
        return $this->morphMany(Science::class, 'relation')->orderby('sort','desc');
    }
    public function publicScience(): morphMany
    {
        return $this->science()->where('is_show', true)->where('is_approved', true);
    }
    public function onApprovalScience(): morphMany
    {
        return $this->science()->where('is_approved', false)->orWhere('is_show', false);
    }

    public function getScienceCabinetListAttribute():string
    {
        return route('science.cabinet.list', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasScienceCabinetList():bool
    {
        return !Route::is('science.cabinet.list');
    }
    public function getScienceCabinetOnApprovalListAttribute():string
    {
        return route('science.cabinet.on-approval', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasScienceCabinetOnApproval():bool
    {
        return !Route::is('science.cabinet.on-approval');
    }
    public function getScienceCabinetAddAttribute():string
    {
        return route('science.cabinet.form', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }

}
