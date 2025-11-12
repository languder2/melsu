@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.__('common.Users') )

@section('content-header')
    @include('users.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')

    @include('users.cabinet.filter')

    <div class="grid gap-3 grid-cols-[auto_1fr_1fr_1fr_auto] mb-3">
        <div
            class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center sticky top-0 text-white border-sky-800 bg-sky-800 text-center"
        >
            <div>
                id
            </div>
            <div class="text-left">
                Email
            </div>
            <div class="text-left">
                ФИО
            </div>
            <div>
                Роль
            </div>
            <div>
            </div>
            <div>
            </div>
            <div>
            </div>
        </div>

        @forelse($list as $item)
            @component('users.cabinet.item', compact('item'))@endcomponent
        @empty

        @endforelse
    </div>

@endsection
