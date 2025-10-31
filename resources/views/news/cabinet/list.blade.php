@extends("layouts.cabinet")

@section('title', 'Новости')

@section('top-menu')
@endsection

@section('content-header')
    @include('news.cabinet.menu')
@endsection

@section('content')
    @include('news.cabinet.filter')

    <div class="flex flex-wrap gap-4 m-3 ms-0">
        @forelse($list as $item)
            @include('news.cabinet.item')
        @empty

        @endforelse
    </div>

    {!! $list->links() !!}

@endsection
