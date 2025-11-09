<?php

namespace App\Traits;

use App\Models\Events\Category as EventCategory;

trait hasEventCategories
{
    public function categories()
    {
        return $this->morphedByMany(
            EventCategory::class,
            'relation',
            'events_relations',
            'event_id',
            'relation_id'
        );
    }
}
