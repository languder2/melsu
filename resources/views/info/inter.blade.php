@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.inter') }}
@endsection

@section('content')

    @component('components.info.table',$inter->template())@endcomponent

@endsection


