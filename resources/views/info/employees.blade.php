@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.employees.title') }}
@endsection

@section('content')

    @component('components.info.employees', $employees->template())@endcomponent

@endsection


