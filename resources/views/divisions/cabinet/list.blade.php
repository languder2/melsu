@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content')

    @include('divisions.cabinet.filter')

    <div class="grid grid-cols-[auto_1fr_repeat(2,auto)] gap-3">
        <div class="grid grid-cols-subgrid col-span-full bg-sky-800 sticky top-0 text-white rounded-sm shadow border-l-3 border-sky-800 px-4 py-1">
            <div class="p-3 text-center">
                id
            </div>
            <div class="p-3">
                Подразделение
            </div>
            <div class="p-3"></div>
            <div class="p-3"></div>
        </div>

        @forelse($list as $division)
            {{ view('divisions.cabinet.item', compact('division')) }}
        @empty
            <div class="col-span-full text-center font-semibold p-3 text-red-800">
                Нет доступных Вам подразделений.
            </div>
        @endforelse
    </div>

@endsection
