@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.standards') }}
@endsection

@section('content')

    @component('components.info.documents',$standards->standards('eduFedDoc'))@endcomponent

    @component('components.info.documents',$standards->standards('eduStandartDoc'))@endcomponent

    @component('components.info.documents',$standards->standards('eduFedTreb'))@endcomponent

    @component('components.info.documents',$standards->standards('eduStandartTreb'))@endcomponent

@endsection


