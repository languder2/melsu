@props([
    'division' => new \App\Models\Division\Division()
])

@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.__('common.Staffs') )

@section('content-header')

    @include('staffs.cabinet.menu')

@endsection

@section('content')

@endsection
