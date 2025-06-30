@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.documents') }}
@endsection

@section('content')

    @component('components.info.documents',$documents->documents('ustavDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('localActStud'))@endcomponent

    @component('components.info.documents',$documents->documents('localActOrder'))@endcomponent

    @component('components.info.documents',$documents->documents('localActCollec'))@endcomponent

    @component('components.info.documents',$documents->documents('reportEduDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('prescriptionDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('priemDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('modeDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('tekKontrolDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('perevodDocLink'))@endcomponent

    @component('components.info.documents',$documents->documents('vozDocLink'))@endcomponent

@endsection


