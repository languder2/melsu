@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.__('common.Documents') )

@section('content-header')

    @include('documents.cabinet.menu')

@endsection

@section('content')

    <div class="grid gap-3 grid-cols-[auto_auto_1fr_auto_auto_auto]">
        @forelse($list as $category)
            @component('documents.cabinet.category',[
                'current'   => $category,
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
