<?php

use function Livewire\Volt\{state, mount};
use App\Models\Page\Page;

state([
    'multiple'      => false,
    'name'          => fn() => $this->multiple ? 'pages[]' : 'page',
    'list'          => fn() => Page::withDepth()->defaultOrder()->get(),
    'required'      => false,
    'current'       => null,
    'withPrefix'    => false,
    'withBg'        => false,
    'title'         => null,
    'showTitle'     => true,
]);

mount(function ($current = null) {
    $this->current = collect($current);

    $this->title   =  $this->title ?: ($this->multiple ? 'Выбрать страницы' : 'Выбрать страницу');

});

?>
<div class="flex flex-col gap-1 @if($withBg) px-3 py-2 bg-white shadow-sm @endif">
    @if($showTitle)
        <div class="font-mono">
            {{ $title }}:
        </div>
    @endif
    <select
        class="jq-select2-withID"
        name="{{ $name }}"
        @required($required)
        @if($multiple) multiple @endif
    >
        @foreach($list as $item)
            <option
                value="{{ $item->id }}"
                @selected($current->contains($item->id))
            >
                {{ $item->id }}
                |
                {!! $withPrefix ? $item->name_with_prefix_level : $item->name !!}
            </option>
        @endforeach
    </select>
</div>
