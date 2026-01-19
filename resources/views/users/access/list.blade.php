@extends("layouts.cabinet")

@section('title', __('common.Cabinet') .' → '. $instance->name .' → '. __('common.Users') )

@section('content-header')
    <div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

        <div class="flex items-center">
            <div>
                {!! $instance->name !!}  → {{ mb_ucfirst(__('common.allowed users')) }}
            </div>

        </div>
    </div>
@endsection

@section('content')

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
            <div class="text-left">
                Роль
            </div>
            <div>
            </div>
        </div>

        @forelse($list as $item)
            @component('users.access.item', compact('item', 'instance'))@endcomponent
        @empty

        @endforelse
    </div>


    @include('users.access.form')

@endsection
