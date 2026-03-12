<?php

namespace App\Traits;

use App\Models\Division\Division;
use App\Models\Events\Events;
use App\Models\News\News;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
    public function publicEvents2($withTree = true): Collection
    {
        $IDs = [$this->id];

        if($this instanceof Division && $withTree)
            $IDs   = Division::descendantsAndSelf($this->id)->pluck('id');

        $eIDs = DB::table('events_relations')
            ->whereIn('relation_id', $IDs)
            ->where('relation_type', $this::class)
            ->get()
            ->pluck('event_id')->unique();

        return \App\Models\News\Events::whereIn('id', $eIDs)
            ->where('is_show',1)
            ->where('has_approval',true)
            ->orderBy('event_datetime', 'desc')
            ->orderBy('sort', 'asc')
            ->get();
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
