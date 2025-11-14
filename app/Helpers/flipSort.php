<?php
use Illuminate\Support\Collection;

if (!function_exists('flipSort')) {
    function flipSort(Collection $collection, $current, $direction): void
    {

        $key        = $collection->search(fn($item) => $item->id === $current->id);

        $secondKey  = $key + ($direction === 'up' ? - 1 : 1);

        $flip       =  $collection->get( $secondKey );

        $current->sort = $flip->sort;

        $flip->sort = $current->getRawOriginal('sort');

        $current->save();

        $flip->save();
    }
}
