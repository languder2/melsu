@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.standards') }}
@endsection

@section('content')

    @component('components.info.documents',$standards->getTemplate('eduFedDoc','documents'))@endcomponent
    @component('components.info.documents',$standards->getTemplate('eduStandartDoc','documents'))@endcomponent
    @component('components.info.documents',$standards->getTemplate('eduFedTreb','documents'))@endcomponent
    @component('components.info.documents',$standards->getTemplate('eduStandartTreb','documents'))@endcomponent

@endsection


