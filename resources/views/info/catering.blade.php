@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.catering') }}
@endsection

@section('content')

    @component('components.info.catering.section',$catering->template('meals'))@endcomponent

    @component('components.info.catering.section',$catering->template('health'))@endcomponent

@endsection


