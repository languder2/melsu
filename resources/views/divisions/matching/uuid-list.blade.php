@props([
    'divisions'         => collect(),
    'blockID'           => 'block1'
])

<div id="{{ $blockID }}" class="grid grid-cols-[6ch_1fr_minmax(auto,34ch)] gap-3">
    @foreach($divisions as $item)
        <div class="col-span-full grid grid-cols-subgrid gap-3 lineInSearch">
            <div class="p-3 bg-white shadow-sm flex items-center justify-center">
                {{ $item->id }}
            </div>
            <div class="p-3 bg-white shadow-sm flex items-center">
                @for($i=0 ; $i <= $item->depth; $i++)
                    <span class="p-2"></span>
                @endfor
                @if($item->depth)
                    <span class="p-1 pe-3">{{ __('common.arrowT2R') }}</span>
                @endif

                <div class="flex-1">
                    {{ $item->name }}
                </div>
                <div>
                    <a href="#copy" title="Скопировать" data-copy="{{ $item->name }}"
                       class="hover:text-green-700"
                    >
                        <x-lucide-copy class="w-6" />
                    </a>
                </div>
            </div>
            <div class="p-3 bg-white shadow-sm">
                <x-form.input
                    name="uuid[{{ $item->id }}]"
                    label="UUID"
                    value="{!! $item->uuid !!}"
                    block="flex-1"
                    class="inputMatchedUUID"
                    :data="['link'=> route('division.change.uuid', $item) ]"
                />
            </div>
        </div>
    @endforeach
</div>
