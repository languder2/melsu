@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {!! __('info.common.title') !!}
@endsection

@section('content')

    @component('components.info.common',$common->template()) @endcomponent

    @component('components.info.documents', $documents->getTemplate('licenseDocLink','documents'))@endcomponent

    @component('components.info.documents', $documents->getTemplate('accreditationDocLink','documents'))@endcomponent

    @component('components.info.founder',$founder->template())@endcomponent

    @component('components.info.places',$common->places('addressPlaceSet')) @endcomponent

    @component('components.info.places',$common->places('addressPlacePrac')) @endcomponent

    @component('components.info.places',$common->places('addressPlacePodg')) @endcomponent

    @component('components.info.places',$common->places('addressPlaceGia')) @endcomponent

    @component('components.info.places',$common->places('addressPlaceDop')) @endcomponent

    @component('components.info.places',$common->places('addressPlaceOppo')) @endcomponent

@endsection


