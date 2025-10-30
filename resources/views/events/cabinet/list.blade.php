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

    <div class="grid gap-3 grid-cols-3">
        <div class="grid grid-cols-subgrid col-span-full gap-3">
            <div>
                id
            </div>
            <div>
                title
            </div>
            <div>
                title
            </div>
        </div>
    </div>
    {!! $list->links() !!}

@endsection
