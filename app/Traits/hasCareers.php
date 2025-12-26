<?php

namespace App\Traits;

use App\Enums\Entities;
use App\Models\Minor\Career;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Route;

trait
hasCareers
{
    public function careers(): morphMany
    {
        return $this->morphMany(Career::class, 'relation')->orderby('sort','desc');
    }
    public function publicCareers(): morphMany
    {
        return $this->Careers()->where('is_show', true)->where('is_approved', true);
    }
    public function onApprovalCareers(): morphMany
    {
        return $this->Careers()->where('is_approved', false)->orWhere('is_show', false);
    }

    public function getCareersCabinetListAttribute():string
    {
        return route('careers.cabinet.list', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasCareersCabinetList():bool
    {
        return !Route::is('careers.cabinet.list');
    }
    public function getCareersCabinetOnApprovalListAttribute():string
    {
        return route('careers.cabinet.on-approval', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function hasCareersCabinetOnApproval():bool
    {
        return !Route::is('careers.cabinet.on-approval');
    }
    public function getCareersCabinetAddAttribute():string
    {
        return route('careers.cabinet.form', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function careersCabinetChangeApproved(string $action = 'set', string $range = 'all'):string
    {
        return route('careers.cabinet.change-approved', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id,
            $range,
            $action
        ]);
    }


}
