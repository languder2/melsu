<?php
use Illuminate\Support\Collection;

if (!function_exists('flattenTree')) {
    function flattenTree(Collection $collection, string $parentIdField = 'parent_id', ?int $parentId = null, int $level = 0, bool $isGrouped = false): Collection
    {
        if (!$isGrouped) {
            $grouped = $collection->groupBy($parentIdField);
            return flattenTree($grouped, $parentIdField, null, 0, true);
        }

        $items = $collection->get($parentId, collect());

        $result = collect();

        foreach ($items as $item) {
            $item->level = $level;
            $result->push($item);
            $nested = flattenTree(
                $collection,
                $parentIdField,
                $item->id,
                $level + 1,
                true
            );

            $result = $result->concat($nested);
        }

        return $result;
    }
}
