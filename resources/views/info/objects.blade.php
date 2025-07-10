@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.objects') }}
@endsection

@section('content')

    @component('components.info.objects.purpose-cab',$objects->template('purposeCab'))@endcomponent


    @component('components.info.table',$objects->template('purposePrac'))@endcomponent
    @component('components.info.table',$objects->template('purposeLibr'))@endcomponent
    @component('components.info.table',$objects->template('purposeSport'))@endcomponent

    @component('components.info.text',$objects->content('ovz'))@endcomponent
    @component('components.info.text',$objects->content('purposeFacil'))@endcomponent
    @component('components.info.text',$objects->content('purposeFacilOvz'))@endcomponent
    @component('components.info.text',$objects->content('comNet'))@endcomponent
    @component('components.info.text',$objects->content('comNetOvz'))@endcomponent
    @component('components.info.text',$objects->content('purposeEios'))@endcomponent

    @component('components.info.documents',$objects->getTemplate('erList','documents'))@endcomponent
    @component('components.info.documents',$objects->getTemplate('erListOvz','documents'))@endcomponent
    @component('components.info.documents',$objects->getTemplate('techOvz','documents'))@endcomponent

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


