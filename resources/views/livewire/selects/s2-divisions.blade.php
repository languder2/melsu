<?php

use function Livewire\Volt\{state};
use App\Models\Division\Division;

state([
    'multiple'      => false,
    'name'          => fn() => $this->multiple ? 'divisions[]' : 'division',
    'list'          => fn() => Division::withDepth()->defaultOrder()->get(),
    'required'      => false,
    'current'       => fn() => collect($this->current),
    'withPrefix'    => false
]);

?>
<div>
    <select
        class="jq-select2-withID"
        name="{{ $name }}"
        @required($required)
        @if($multiple) multiple @endif
    >
        <option value="">Подразделение не выбрано</option>
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
