<?php
use Illuminate\Support\Collection;

if (!function_exists('flipSort')) {
    function flipSort(Collection $collection, $current, $direction): void
    {

        $collection->each(fn($item, $index) => $item->update(['sort' => $index*100]));


        $key        = $collection->search(fn($item) => $item->id === $current->id);

        $secondKey  = $key + ($direction === 'up' ? - 1 : 1);

//        dd($collection->pluck('sort','id'), $current->toArray(), $key, $secondKey, $direction);

        $flip       =  $collection->get( $secondKey );

        $current->sort = $flip->sort;

        $flip->sort = $current->getRawOriginal('sort');

        $current->save();

        $flip->save();
    }
}
