@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.$instance->name.' → '.__('common.Contacts') )

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true])@endcomponent
    @include('contacts.cabinet.menu')
@endsection

@section('content')

    @foreach($list as $group)

        <div class="grid gap-3 grid-cols-[auto_auto_1fr_1fr_auto_auto] mb-3">
            <div
                class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center sticky top-0 text-white border-sky-800 bg-sky-800 text-center"
            >
                <div>
                    id
                </div>
                <div class="first-letter:uppercase">
                    {{ __('common.type') }}
                </div>
                <div class="text-left first-letter:uppercase">
                    {{ __('common.title') }}
                </div>
                <div class="text-left">
                    {{ __('common.Contact') }}
                </div>
            </div>

            @forelse($group as $item)
                @component('contacts.cabinet.item',[
                    'item'      => $item,
                    'isFirst'   => $loop->first,
                    'isLast'    => $loop->last,
                ])@endcomponent
            @empty

            @endforelse
        </div>
    @endforeach

@endsection
