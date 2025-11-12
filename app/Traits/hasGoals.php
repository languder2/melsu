<?php

namespace App\Traits;

use App\Enums\Entities;
use App\Models\Minor\Goals;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait
hasGoals
{
    public function goals(): morphMany
    {
        return $this->morphMany(Goals::class, 'relation')->orderby('sort');
    }
    public function publicGoals(): morphMany
    {
        return $this->goals()->where('is_show', true)->where('is_approved', true);
    }
    public function onApprovalGoals(): morphMany
    {
        return $this->goals()->where('is_approved', false);
    }

    public function getGoalsCabinetListRouteAttribute():string
    {
        return 'goals.cabinet.list';
    }
    public function getGoalsCabinetListAttribute():string
    {
        return route($this->GoalsCabinetListRoute, [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }
    public function getGoalsCabinetOnApprovalListRouteAttribute():string
    {
        return 'goals.cabinet.on-approval';
    }
    public function getGoalsCabinetOnApprovalListAttribute():string
    {
        return route($this->GoalsCabinetOnApprovalListRoute, [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }

    public function getGoalsCabinetAddAttribute():string
    {
        return route('goals.cabinet.form', [
            'entity' => Entities::getEntityByModel($this::class)->value,
            'entity_id' => $this->id
        ]);
    }

}
