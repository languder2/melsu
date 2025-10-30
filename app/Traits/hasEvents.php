<?php

namespace App\Traits;

use App\Enums\DivisionType;
use App\Models\News\Events;
use App\Models\News\News;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait hasEvents
{
    public function events(): MorphMany
    {
        return $this->morphMany(Events::class, 'relation')
            ->orderBy('published_at');
    }
    public function publicEvents(): MorphMany
    {
        return $this->events()
            ->where('is_show',1)
            ->where('has_approval',true)
            ->orderBy('sort')
        ;
    }
}
