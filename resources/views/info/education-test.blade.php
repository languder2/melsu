@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.education.title') }}. Сводная
@endsection

@section('content')

    @php $time = microtime(true) @endphp

    @component('components.info.education.education-test', [
        'filters'   => $filters,
        'list'      => $list
    ])@endcomponent

    @php $time = microtime(true)-$time @endphp

    @dump($time)

@endsection


