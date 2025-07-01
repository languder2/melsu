@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.documents') }}
@endsection

@section('content')

    @component('components.info.documents',$documents->getTemplate('ustavDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('localActStud','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('localActOrder','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('localActCollec','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('reportEduDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('prescriptionDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('priemDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('modeDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('tekKontrolDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('perevodDocLink','documents'))@endcomponent

    @component('components.info.documents',$documents->getTemplate('vozDocLink','documents'))@endcomponent

@endsection


