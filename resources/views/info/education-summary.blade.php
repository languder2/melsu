@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.education.title') }}. Сводная
@endsection

@section('content')
    @component('components.info.education.education-summary', [
        'filters'   => $filters,
        'list'      => $list
    ])@endcomponent
@endsection


