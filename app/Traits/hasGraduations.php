<?php

namespace App\Traits;

use App\Enums\Entities;
use App\Models\Minor\Graduation;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Route;

trait
hasGraduations
{
    public function graduations(): morphMany
    {
        return $this->morphMany(Graduation::class, 'relation')->orderby('sort','desc');
    }
    public function publicGraduations(): morphMany
    {
        return $this->graduations()->where('is_show', true)->where('is_approved', true);
    }
    public function onApprovalGraduations(): morphMany
    {
        return $this->graduations()->where('is_approved', false)->orWhere('is_show', false);
    }

    public function getGraduationsCabinetListAttribute():string
    {
        return route('graduations.cabinet.list', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasGraduationsCabinetList():bool
    {
        return !Route::is('graduations.cabinet.list');
    }
    public function getGraduationsCabinetOnApprovalListAttribute():string
    {
        return route('graduations.cabinet.on-approval', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasGraduationsCabinetOnApproval():bool
    {
        return !Route::is('graduations.cabinet.on-approval');
    }
    public function getGraduationsCabinetAddAttribute():string
    {
        return route('graduations.cabinet.form', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }

}
