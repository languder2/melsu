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

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }
    public function tree(?Collection &$collection = null, int $level = 0): Collection
    {
        if(is_null($collection)){
            $this->level = $level;
            $collection = collect([$this]);
        }

        $this->subs->each(function ($sub) use ($collection, $level) {
            $sub->level = $level + 1;

            $collection->push($sub);

            if($sub->subs->isNotEmpty())
                $sub->tree($collection, $level + 1);
        });

        return $collection;
    }

    public function subsTree(): Collection
    {
        return $this->tree()->filter(fn($item) => $item->level)->each(fn($item) => $item->level = $item->level - 1);
    }
    public static function fullTree(): Collection
    {
        return flattenTree(self::all())->keyBy('id');
    }

}

