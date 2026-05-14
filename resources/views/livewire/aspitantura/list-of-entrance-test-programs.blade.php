<?php

use function Livewire\Volt\{state};

state([
    'list'  => (\App\Models\Documents\DocumentCategory::find(113))->documents()
        ->with('tags')
        ->whereHas('tags', fn($query) => $query->where('name', 'Аспирантура'))
        ->whereHas('tags', fn($query) => $query->where('name', 'ви'))
        ->get()
        ->sortBy('title'),

])

?>

<section class="container custom1">
    <div class="bg-white p-6 mb-5">
        <ul class="doc-list list-none list-inside marker:text-[var(--secondary-color)] text-[var(--main-color)]">
            @foreach($list as $item)
                <li class="leading-[1.8rem] pb-3">
                    <a class="flex items-center" target="_blank" href="{{ url($item->link) }}">
                        <i class="bi bi-file-earmark-pdf-fill text-[var(--secondary-color)] text-[30px] me-3"></i>
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
