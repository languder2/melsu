<?php

namespace App\Traits;

use App\Models\Global\Options;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
    public function setOption(string $code = 'content', ?string $value = null): void
    {
        if(is_null($value))
            $this->option($code)->forceDelete();

        else
            $this->option($code)->fill(['property' => $value])->save();
    }
    public function getOption(string $code = 'content'): ?string
    {
        return $this->option($code)->property;
    }

    public function setOptions(array $props = []): void
    {
        foreach ($props as $code => $value)
            $this->setOption($code, $value);
    }

    public function getOptions(array $codes = []): MorphMany
    {
        return $this->options()->whereIn('code', $codes);
    }

    public function removeOptions(array $codes = []): void
    {
        $this->options()->whereIn('code', $codes)->delete();
    }



}
