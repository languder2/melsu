@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.grants') }}
@endsection

@section('content')

    @component('components.info.documents',$grants->getTemplate('localAct','documents'))@endcomponent

    @component('components.info.documents',$grants->getTemplate('grant','documents'))@endcomponent

    @component('components.info.documents',$grants->getTemplate('support','documents'))@endcomponent

    @component('components.info.dormitories',[
        'dormitoryNumbers'                  => $objects->getProperty('hostelInfo'),
        'dormitoryPlaces'                   => $objects->getProperty('hostelNum'),
        'dormitoryPlacesForDisabilities'    => $objects->getProperty('hostelNumOvz'),
        'boardingNumbers'                   => $objects->getProperty('interInfo'),
        'boardingPlaces'                    => $objects->getProperty('interNum'),
        'boardingPlacesForDisabilities'     => $objects->getProperty('interNumOvz'),
    ])@endcomponent

    @component('components.info.text',$objects->content('hostelInterOvz'))@endcomponent

    @component('components.info.documents',$objects->getTemplate('localActObSt','documents'))@endcomponent

@endsection


