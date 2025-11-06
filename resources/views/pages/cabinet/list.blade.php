@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
    @include('pages.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')

    {{--    @include('events.cabinet.filter')--}}

    <div class="grid gap-3 grid-cols-[auto_auto_1fr_auto] mb-3">
        <div
            class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center sticky top-0 text-white border-sky-800 bg-sky-800 text-center"
        >
            <div>
                id
            </div>
            <div></div>
            <div>
                Страница
            </div>
            <div></div>
        </div>

        @forelse($list as $item)
            @component('pages.cabinet.item', compact('item'))@endcomponent
        @empty

        @endforelse
    </div>

{{--    {!! $list->links() !!}--}}

@endsection
