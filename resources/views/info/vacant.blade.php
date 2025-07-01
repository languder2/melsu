@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.vacant.title') }}
@endsection

@section('content')

    @component('components.info.vacant', $vacant->template('vacant'))@endcomponent

@endsection


