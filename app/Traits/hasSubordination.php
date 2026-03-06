<?php

namespace App\Traits;

use App\Models\Division\Division;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait hasSubordination
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function subs($type = null): HasMany
    {
        $builder = $this->hasMany(self::class, 'parent_id','id');

        if(Schema::hasColumn($this->getTable(), 'sort'))
            $builder->orderBy('sort');

        if($type)
            $builder->where('type', $type);

        return $builder;
    }

    public function publicSubs(): HasMany
    {
        $builder = $this->hasMany(self::class, 'parent_id','id')
            ->where('is_show', true)
            ->where('is_approved', true)
        ;

        if(Schema::hasColumn($this->getTable(), 'sort'))
            $builder->orderBy('sort');

        return $builder;
    }

    public function allSubs()
    {
        return $this->subs()->with('allSubs');
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

    public function getLevel(): int
    {
        $level = 0;

        if($this->parent)
            $level = $this->parent->getLevel() + 1;

        if($level>10)
            dd($this);

        return $level;
    }

    public function prefixLevel(): string
    {
        return str_repeat('&nbsp;', $this->getLevel()*3)
            . ($this->getLevel() ? __('common.arrowT2R')  : '' )
            . '&nbsp;';
    }

    private static function getTreeData()
    {
        return self::select('id', 'parent_id', 'name')->get();
    }
    public static function flattenTree(bool $forced = false): Collection
    {
        if ($forced)
            Cache::forget('flattenTree');

        return Cache::rememberForever('flattenTree', function () {
            return flattenList(self::getTreeData())->keyBy('id');
        });
    }
    public function flattenBranch(bool $forced = false): Collection
    {
        $key = 'flattenBranch' . $this->id;

        if ($forced)
            Cache::forget($key);

        return Cache::rememberForever($key, function () {
            return flattenList(self::getTreeData(), 'id', 'parent_id', $this->id)->keyBy('id');
        });
    }
    public static function refreshCachesForId($id = null): void
    {
        self::flattenTree(forced: true);

        if ($id) {
            $item = self::find($id);

            if ($item)
                $item->flattenBranch(forced: true);
        }
    }
    public function getRootId(string $field = 'parent_id', string $key = 'id'): int
    {
        if (!$this->{$field})
            return $this->{$key};

        $tableName = $this->getTable();

        $sql = "
            WITH RECURSIVE tree_path AS (
                SELECT $key, $field FROM $tableName WHERE $key = ?
                UNION ALL
                SELECT t.$key, t.$field FROM $tableName t
                INNER JOIN tree_path tp ON t.$key = tp.$field
            )
            SELECT $key FROM tree_path WHERE $field IS NULL LIMIT 1
        ";

        $result = DB::select($sql, [$this->{$key}]);

        return $result[0]->id ?? $this->id;
    }
}

