@props([
    'list'      => [],
    'target'    => 'styled-select-' . \Illuminate\Support\Str::random(20),
    'label'     => "Добавить",
    'name'      => null,
    'values'    => collect(),
    'open'      => false,
    'required',
])
@php
    $values = ($values instanceof \Illuminate\Support\Collection) ? $values : collect($values)
@endphp

<div data-ssws="{{ $target }}" class="bg-white shadow p-3 relative styled-select-with-search">
    <input
        id="{{ $target }}"
        type="hidden"
        name="{{ $name }}"
        value="{{ json_encode($values ) }}"
        class="w-full"
    >

    <div class="flex gap-3 flex-wrap selectedVariants">
        <div>
            <a
                data-for="{{ $target }}"
                href="#"
                class="peer button-ssws text-sky-800 hover:underline underline-offset-2 p-2 flex items-center"
                @if($open) open @endif
            >
                + {{ $label }}
            </a>
            <div
                data-for="{{ $target }}"
                class="
            opacity-0 max-h-0 overflow-hidden
            peer-open:max-h-200 peer-open:opacity-100
            transition-opacity duration-300
            absolute shadow z-20 bg-white
            border left-0 mt-4 xl:min-w-xl

        "
            >
                <div class="p-3">
                    <input type="text" placeholder="найти" value=""
                           data-for="{{ $target }}"
                           class="search outline-0 border rounded-sm mb-3 p-3 w-full"
                    >

                    <div class="variants overflow-y-scroll max-h-100 rounded-sm border">
                        @foreach($list as $key => $item)
                            <div data-id="{{ $key }}"
                                 data-for="{{ $target }}"
                                 data-value="{{ $key }}"
                                 class="variant cursor-pointer p-2 hover:bg-neutral-100 open:bg-sky-100 open:hover:bg-sky-200"
                                 @if($values->contains($key)) open @endif
                            >
                                {!! $item !!}
                            </div>
                        @endforeach
                        <div
                            class="p-2 emptyResults @if(count($list)) hidden @endif"
                        >
                            Нет результатов
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
