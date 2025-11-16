@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.$instance->name.' → '.__('common.Goals') )

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true ])@endcomponent
    @include('goals.cabinet.menu')
@endsection

@section('content')

{{--    @include('events.cabinet.filter')--}}

    <div class="grid gap-3 grid-cols-[auto_1fr_auto_auto] mb-3">
        <div
            class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center sticky top-0 text-white border-sky-800 bg-sky-800 text-center"
        >
            <div>
                id
            </div>
            <div class="text-left">
                Цель
            </div>
            <div>
            </div>
        </div>

        @forelse($list as $item)
            @component('goals.cabinet.item',[
                'item'      => $item,
                'isFirst'   => $loop->first,
                'isLast'    => $loop->last,
            ])@endcomponent
        @empty

        @endforelse
    </div>

@endsection
