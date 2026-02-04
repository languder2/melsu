@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.$instance->name.' → '.__('common.Documents') )

@section('content-header')

    @if($instance instanceof \App\Models\Division\Division)
        @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true])@endcomponent
    @elseif($instance instanceof \App\Models\Page\Page)
        @component('pages.cabinet.item', ['item' => $instance, 'has_menu' => true])@endcomponent
    @endif

    @include('documents.relation.menu')

@endsection

@section('content')

    <div class="grid gap-3 grid-cols-[auto_auto_1fr_auto_auto_auto]">
        @forelse($list as $item)
            @component('documents.relation.category',[
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
