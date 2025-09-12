@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content')

    <div class="flex flex-wrap gap-4 m-3 ms-0">
        @forelse($list as $item)
            <div class="max-w-150 overflow-hidden">
                @dump($item)
            </div>
        @empty

        @endforelse
    </div>


@endsection
