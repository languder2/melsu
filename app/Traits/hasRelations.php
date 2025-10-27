<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait hasRelations
{
    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
