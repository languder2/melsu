@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
    @include('pages.cabinet.menu')
@endsection

@section('top-menu')
@endsection

@section('content')
    @include('pages.cabinet.filter')

    {{--    @include('events.cabinet.filter')--}}

    <div class="grid gap-3 grid-cols-[auto_1fr_auto_auto_auto] mb-3">
        <div
            class="grid grid-cols-subgrid col-span-full gap-3 items-center sticky top-0 text-white text-center"
        >
            <div class="p-3 rounded-sm shadow bg-sky-800">
                id
            </div>
            <div class="p-3 rounded-sm shadow bg-sky-800 col-span-4 text-left">
                Страница
            </div>
        </div>

        @forelse($list as $item)
            @component('pages.cabinet.item', compact('item'))@endcomponent
        @empty

        @endforelse
    </div>

{{--    {!! $list->links() !!}--}}

@endsection
