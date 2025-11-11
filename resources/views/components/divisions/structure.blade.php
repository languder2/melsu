@props([
    'list'          => collect(),
    'division',
    'slot'          => 'Структура',
    'hideTitle'     => false
])

@if(!$hideTitle && strlen($slot))
    <h3 class="font-semibold text-2xl mb-3">
        {{ $slot }}
    </h3>
@endif

<div class="grid grid-cols-[1fr_repeat(5,auto)] gap-3 bg-white p-3">
    @foreach($list as $item)
        <div class="grid grid-cols-subgrid col-span-full border-b last:border-none   border-gray-200 py-2">
            <div class="flex">
                <div class="break-words sm:break-normal text-sm sm:text-base">
                    @for($i = 0; $i < ($item->level ?? 1) -1 ; $i++)
                        <span class="inline-block mx-3"></span>
                    @endfor
                    @if($item->level)
                        <i class="fas fa-level-up-alt rotate-90 mx-2"></i>
                    @endif

                    @isset($item->link)
                        <a href="{{ $item->link }}" class="hover:underline hover:text-base-red">
                            {{ $item->name }}
                        </a>
                    @else
                        <span>
                        {{ $item->name }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    @endforeach


</div>
