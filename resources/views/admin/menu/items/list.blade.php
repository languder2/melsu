@if(!$list->count())
    <div
        class="
            p-4
            border border-red-800 border-l-4
            rounded-lg
            bg-stone-50
            font-semibold
        "
    >
        Меню не найдено
    </div>
@else
    @foreach($list as $menu)

        @if($menu->items->count() === 0)  @continue  @endif

        <h3
            class="
                text-xl font-semibold mt-6 mb-2
            "
        >
            {{$menu->name}}
        </h3>
        <div
            class="
                bg-stone-50 p-4
                grid gap-4 items-center
                grid-cols-[5ch_auto_3fr_1fr_3fr_auto]
            "
        >
            <div class="font-semibold">
                ID
            </div>
            <div class="font-semibold">
                Preview
            </div>
            <div class="font-semibold">
                Наименование
            </div>
            <div class="font-semibold">
                Parent
            </div>
            <div class="font-semibold">
                Link
            </div>
            <div class="font-semibold">
                btns
            </div>

            @foreach($menu->items as $item)
                {{ view('admin.menu.items.item',['item'=>$item, "level" => isset($level)?$level+1:0 ]) }}
            @endforeach
        </div>

    @endforeach
@endif
