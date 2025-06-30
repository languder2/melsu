@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.education') }}
@endsection

@section('content')

    @component('components.info.education',$education->template())@endcomponent

@endsection


