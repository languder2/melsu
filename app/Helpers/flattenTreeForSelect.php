<?php
use Illuminate\Support\Collection;

if (!function_exists('flattenTree')) {
    /**
     * Преобразует плоскую коллекцию с иерархией в плоскую коллекцию
     * с добавлением уровня вложенности, начиная с указанного родителя.
     *
     * @param Collection $collection Исходная плоская или уже группированная коллекция.
     * @param string $parentIdField Имя поля для родительского ID (по умолчанию 'parent_id').
     * @param mixed $startParentId ID родителя, с которого начинать обход (по умолчанию null).
     * @param int $level Текущий уровень вложенности (только для рекурсии).
     * @return Collection
     */
    function flattenTree(Collection $collection, string $parentIdField = 'parent_id', $startParentId = null, int $level = 0): Collection
    {
        $isGrouped = $collection->keys()->contains(function ($key) {
            return !is_int($key);
        });

        if (!$isGrouped) {
            $grouped = $collection->groupBy($parentIdField);
            return flattenTree($grouped, $parentIdField, $startParentId, 0);
        }

        $items = $collection->get($startParentId, collect());

        $result = collect();

        foreach ($items as $item) {
            $item->level = $level;
            $result->push($item);

            $nested = flattenTree(
                $collection,
                $parentIdField,
                $item->id,
                $level + 1
            );

            $result = $result->concat($nested);
        }

        return $result;
    }
}

if (!function_exists('flattenTreeForSelect')) {
    function flattenTreeForSelect(Collection $collection, $filter = [], string $parentIdField = 'parent_id', $startParentId = null): Collection
    {
        return flattenTree($collection, $parentIdField, $startParentId)
            ->filter(fn($item) => !count($filter) || in_array($item->id, $filter))
            ->keyBy('id')
            ->map(
                fn ($item) =>
                    str_repeat('&nbsp;', $item->level*3)
                    . ($item->level ? __('common.arrowT2R')  : '' )
                    . $item->name
            );
    }
}
