@if($list->count())
    <h2 class="font-bold text-3xl">
        {{$slot}}
    </h2>

    <div class="grid gap-4 grid-cols-2 lg:grid-cols-2">
        @foreach($list as $item)
            <div
                @class([
                    'p-5',
                    in_array($loop->index % 4,[1,2]) ? 'bg-white' : 'bg-red-900 text-white'
                ])
            >
                <div class="flex gap-4">
                    <div class="flex-1 text-xl font-semibold">
                        {!! $item->name !!}
                    </div>

                    @if($item->salary)
                        <div class="text-center">
                            <p class="text-2xl font-semibold">
                                от {!! $item->salary !!} тыс.
                            </p>
                            <p class="text-lg">
                                Зарплата, ₽
                            </p>
                        </div>
                    @endif
                </div>
                <div class="text-lg mt-3">
                    {!! $item->content !!}
                </div>
            </div>
        @endforeach
    </div>
@endif
