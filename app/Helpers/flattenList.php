<?php
use Illuminate\Support\Collection;

if (!function_exists('flattenList')){
    function flattenList(Collection $list, string $fieldID = 'id', string $fieldParentID = 'parent_id'): Collection
    {
        $grouped = $list->groupBy($fieldParentID);


        $allIds = $list->pluck($fieldID)->toArray();
        $roots = $list->filter(function ($item) use ($allIds, $fieldParentID, $fieldID) {
            return empty($item->{$fieldParentID}) || !in_array($item->{$fieldParentID}, $allIds);
        });

        $result = collect();

        $flatten = function ($items, $depth = 0) use (&$flatten, $grouped, &$result, $fieldID, $fieldParentID) {
            foreach ($items as $item) {
                $item->depth            = $depth;
                $item->nameWithLevel    = str_repeat('&nbsp;', $depth*3) .
                    ($depth ? __('common.arrowT2R')  : '' ) . $item->name;

                $result->push($item);

                if ($grouped->has($item->{$fieldID}))
                    $flatten($grouped->get($item->{$fieldID}), $depth + 1);
            }
        };

        $flatten($roots);

        return $result;
    }
}


