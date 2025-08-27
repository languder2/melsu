<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasRelations
{
    public function relation(): MorphTo
    {
        return $this->morphTo();
    }
}
