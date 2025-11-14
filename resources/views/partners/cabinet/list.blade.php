@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.$instance->name.' → '.__('common.Partners') )

@section('content-header')
    @include('partners.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')
    <div class="grid gap-3 grid-cols-[auto_1fr_auto_auto]">
        @forelse($list as $item)
            @component('partners.cabinet.category',[
                'item'      => $item,
                'isFirst'   => $loop->first,
                'isLast'    => $loop->last,
            ])@endcomponent
        @empty
            <div class="p-3 bg-white shadow col-span-full text-center">
                Нет активных категорий
            </div>
        @endforelse
    </div>
@endsection
