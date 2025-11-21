<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait hasSubordination
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function subs($type = null): HasMany
    {
        $builder = $this->hasMany(self::class, 'parent_id','id');

        if($type)
            $builder->where('type', $type);

        return $builder;
    }
    public function tree(?Collection &$collectionion = null, int $level = 0): Collection
    {
        if(is_null($collectionion)){
            $this->level = $level;
            $collectionion = collect([$this]);
        }

        $this->subs->each(function ($sub) use ($collectionion, $level) {
            $sub->level = $level + 1;

            $collectionion->push($sub);

            if($sub->subs->isNotEmpty())
                $sub->tree($collectionion, $level + 1);
        });

        return $collectionion;
    }

    public function subsTree(): Collection
    {
        return $this->tree()->filter(fn($item) => $item->level)->each(fn($item) => $item->level = $item->level - 1);
    }
    public static function fullTree(): Collection
    {
        return flattenTree(self::all())->keyBy('id');
    }

    public function getFlattenTree(bool $nameWithLevel = false ,Collection $collection = null, int $level = 0):Collection
    {
        if(is_null($collection))
            $collection = collect();

        $this->level = $level;

        if($nameWithLevel)
            $this->name = str_repeat('&nbsp;', $level*3)
            . ($level ? __('common.arrowT2R')  : '' )
            . $this->name;

        $collection->put($this->id, $this);

        $this->subs->each(fn($item) => $item->getFlattenTree($nameWithLevel, $collection, $level + 1));

        return $collection;
    }

}

