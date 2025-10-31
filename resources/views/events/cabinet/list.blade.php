@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
    @include('events.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')

    @include('events.cabinet.filter')

    <div class="grid gap-3 grid-cols-[repeat(7,auto)]">
        @component('events.cabinet.item',[
            'isHeader'  => true,
        ])@endcomponent

        @forelse($list as $item)
            @component('events.cabinet.item', compact('item'))@endcomponent
        @empty

        @endforelse
    </div>

    {!! $list->links() !!}

@endsection
