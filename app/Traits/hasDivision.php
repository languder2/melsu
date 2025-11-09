<?php

namespace App\Traits;

use App\Models\Division\Division;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait hasDivision
{
    protected function getDivisionsConfig(string $key = null): mixed
    {
        $config = $this->traitsConfig['divisions'] ?? [];

        if ($key)
            return $config[$key] ?? null;

        return $config;
    }
    public function divisions(): MorphToMany
    {
        return $this->morphedByMany(
            Division::class,
            'relation',
            $this->getDivisionsConfig('table') ?? 'news_relations',
            $this->getDivisionsConfig('foreignKey') ?? 'news_id',
            'relation_id'
        );
    }
}
