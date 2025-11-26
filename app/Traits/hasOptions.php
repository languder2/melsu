<?php

namespace App\Traits;

use App\Models\Global\Options;
use App\Models\Services\Content;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait hasOptions
{
    public function options(): MorphMany
    {
        return $this->morphMany(Options::class, 'relation');
    }

    public function option(string $code = 'content'): Options
    {
        return $this->MorphOne(Options::class, 'relation')
            ->where('code', $code)
            ->first()
            ?? (new Options(['code' => $code]))->relation()->associate($this);
    }

}
