@props([
    'list'      => collect(),
    'slot'      => null
])
@if($list->isNotEmpty())
    @if($slot)
        <h3 class="font-semibold text-xl">
            {{ $slot }}
        </h3>
    @endif

    <div class="grid gap-3 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
        @foreach($list as $item)
            <div class="flex flex-col gap-3">
                <img
                    src="{{ $item->image->src }}"
                    alt=""
                    class="object-cover object-top bg-gray-200 w-full h-100"
                />
                <h4 class="text-base-red font-semibold">
                    {{ $item->name }}
                </h4>

                <div class="line-clamp-4">
                    {!! $item->content()->render() !!}
                </div>

            </div>
        @endforeach
    </div>
@endif
