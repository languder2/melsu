@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
    <div class="mb-3 p-3 bg-white flex gap-3 justify-between items-center">
        <div class="text-xl font-semibold">
            Новости
        </div>
        <div>
            <a href="{{ route('news.cabinet.form') }}"
               class="
                    bg-blue-900 px-4 py-2 text-white rounded-md hover:bg-blue-700 active:bg-gray-700 cursor-pointer
                "
            >
                Добавить новость
            </a>
        </div>
    </div>
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
