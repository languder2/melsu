<?php
use Illuminate\Support\Collection;

if (!function_exists('flipSort')) {
    function flipSort(Collection $collection, $current, $direction): void
    {

        $key        = $collection->search(fn($item) => $item->id === $current->id);

        $flip       = ($direction === 'up') ? $collection->get($key - 1) : $collection->get($key + 1);

        $current->sort = $flip->sort;
        $flip->sort = $current->getRawOriginal('sort');

        $current->save();
        $flip->save();
    }
}
