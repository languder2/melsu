@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
    @include('events.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')

    @include('events.cabinet.filter')

    <div class="grid gap-3 grid-cols-[repeat(8,auto)] mb-3">
        <div
            class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center sticky top-0 text-white border-sky-800 bg-sky-800 text-center"
        >
            <div>
                id
            </div>
            <div>
            </div>
            <div>
                Дата и время
            </div>
            <div class="text-left">
                Название
            </div>
            <div>
                Автор
            </div>
            <div>
                Категория
            </div>
            <div>
                Подразделение
            </div>
            <div>
            </div>
        </div>

        @forelse($list as $item)
            @component('events.cabinet.item', compact('item'))@endcomponent
        @empty

        @endforelse
    </div>

    {!! $list->links() !!}

@endsection
