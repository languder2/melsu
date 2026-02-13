@props([
    'json'              => collect(),
    'blockID'           => 'block2'
])

<div id="{{ $blockID }}" class="grid grid-cols-[1fr_minmax(auto,34ch)] gap-3">
    @foreach($json as $item)
        @php
            $class = $item->disbanded ? "bg-red-900 text-white" : ($item->deleted ? 'bg-gray-800 text-white' : 'bg-white')
        @endphp

        <div class="col-span-full grid grid-cols-subgrid gap-3 lineInSearch">
            <div class="p-3 shadow-sm flex items-center {{ $class }}">
                @for($i=0 ; $i <= $item->depth; $i++)
                    <span class="p-2"></span>
                @endfor
                @if($item->depth)
                    <span class="p-1 pe-3">{{ __('common.arrowT2R') }}</span>
                @endif
                <div class="flex-1">
                    {{ $item->name }}
                </div>
            </div>
            <div class="p-3 shadow-sm flex items-center {{ $class }}">
                <div class="flex-1">
                    {{ $item->GUID_Dep }}
                </div>
                <div>
                    <a href="#copy" title="Скопировать" data-copy="{{ $item->GUID_Dep }}"
                       class="hover:text-green-700"
                    >
                        <x-lucide-copy class="w-6" />
                    </a>

                </div>
            </div>
        </div>
    @endforeach
</div>
