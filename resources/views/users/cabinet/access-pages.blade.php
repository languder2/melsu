@props([
    'list' => collect(),
])

@if($list->isNotEmpty())
    <div id="blockSetDivisionAccess" class="flex flex-col gap-3 mt-4">
        <h3 class="font-semibold text-xl">
            Имеющийся доступ к страницам
        </h3>

        <div class="flex flex-col gap-3">
            @foreach($list as $item)
                <label
                    class="
                group grid grid-cols-[auto_auto_1fr] col-span-full bg-white shadow group select-none cursor-pointer rounded-sm
                hover:bg-sky-700 hover:text-white duration-200
            "
                >
                    <input type="checkbox" name="pages[]" value="{{ $item->id }}" class="peer hidden" checked>

                    <span class="p-3">
                        {{ $item->id }}
                    </span>

                    <span class="opacity-0 peer-checked:opacity-100 p-3">
                        <x-lucide-check class="w-6 duration-200"/>
                    </span>

                    <span class="p-3 flex gap-3">
                        {!! $item->name !!}
                    </span>
                </label>
            @endforeach
        </div>
    </div>
@endif
