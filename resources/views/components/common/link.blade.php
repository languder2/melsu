@props([
    'document' => null
])

@if($document)

    <div class="flex flex-col md:grid md:grid-cols-[1fr_20ch] items-center gap-3 p-3 px-7 bg-white shadow-sm">
        <div class="flex gap-3">
            @if($document->parent_id)
                <div class="w-6 flex items-center">
                    <x-lucide-corner-down-right class="w-6 text-base-red"/>
                </div>
            @endif
            <div class="font-medium my-0 text-gray-900 leading-tight flex flex-col gap-1">
                <div>
                    {!! $document->html('before') !!}
                </div>

                <div class="{{ ($document->length('before') + $document->length('after')) ? "font-semibold text-base-red" : '' }}">
                    {{ $document->title }}
                </div>

                <div>
                    {!! $document->html('after') !!}
                </div>
            </div>

        </div>
        <a href="{{ $document->getOption('link') }}"
           {{--       download--}}
           target="_blank"
           class="
                hover:text-base-red duration-150 transition-all font-semibold gap-3 items-center group
                select-none text-end
           "
        >
            <div>
                Перейти
            </div>
        </a>
    </div>



@endif
