@extends("layouts.admin")

@section('title', 'Админ панель: Пункты меню')

@section('top-menu')
    @include('menu.admin.includes.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        Пункты меню
        @slot('link')
            {{ route('admin:menu-items:add') }}
        @endslot
    @endcomponent
@endsection

@section('content')

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
                grid-cols-[5ch_auto_2fr_1fr_auto]
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
                    Link
                </div>
                <div class="font-semibold">
                    btns
                </div>

                @foreach($menu->items as $item)
                    @component('menu.admin.items.item',['item'=>$item, "level" => isset($level)?$level+1:0 ])@endcomponent
                @endforeach
            </div>

        @endforeach
    @endif
@endsection
