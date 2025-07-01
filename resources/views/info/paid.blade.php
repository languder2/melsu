@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.paid.title') }}
@endsection

@section('content')

    @component('components.info.documents',$paid->getTemplate('paidEdu','documents'))@endcomponent

    @component('components.info.documents',$paid->getTemplate('paidDog','documents'))@endcomponent

    @component('components.info.documents',$paid->getTemplate('paidSt','documents'))@endcomponent

    @component('components.info.documents',$paid->getTemplate('paidParents','documents'))@endcomponent

@endsection


