<?php

namespace App\Traits;

use App\Models\Events\Events;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait hasEvents
{
    public function events(): MorphToMany
    {
        return $this->morphToMany(
            Events::class,
            'relation',
            'events_relations',
            'relation_id',
            'event_id'
        );
    }
    public function publicEvents(): Collection
    {
        return
            $this->getFlattenTree()->flatMap(fn($item) => $item->events)->unique('id')->sortByDesc('event_datetime')
            ->filter(fn($item) => $item->is_show && $item->has_approval);
    }

    public function allEvents(): Collection
    {
        return $this->getFlattenTree()->flatMap(fn($item) => $item->events)->unique('id')->sortByDesc('event_datetime');
    }


}
