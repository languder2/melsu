@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.catering') }}
@endsection

@section('content')

    @component('components.info.table',$catering->template('meals'))@endcomponent

    @component('components.info.table',$catering->template('health'))@endcomponent

@endsection


