@props([
    'division'  => new \App\Models\Division\Division(),
    'leaders'   => collect(),
    'staffs'    => collect()
])

@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.__('common.Staffs') )

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $division, 'has_menu' => true])@endcomponent

    @include('divisions.cabinet.staffs.menu')
@endsection

@section('content')
    <div class="flex flex-col gap-3">
        @component('divisions.cabinet.staffs.group',[
            'division'  => $division,
            'list'      => $leaders,
            'isLeaders' => true
        ])@endcomponent

        @component('divisions.cabinet.staffs.group',[
            'division'  => $division,
            'list'      => $staffs,
        ])@endcomponent
    </div>
@endsection
