@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    Общие сведения
@endsection

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-[500px_1fr] gap-2">

        @component('components.info.common')
            @slot('itemprop')
                Название
            @endslot
            @slot('label')
                Название
            @endslot
            @slot('content')
                значение
            @endslot
            @slot('header') 1 @endslot
        @endcomponent

        @foreach($common->base() as $item)
            @component('components.info.common')
                @slot('itemprop')
                    {!! $item->prop !!}
                @endslot
                @slot('label')
                    {!! $item->label !!}
                @endslot
                @slot('content')
                    {!! $item->content->implode(', ') !!}
                @endslot
            @endcomponent
        @endforeach
    </div>

    @component('components.info.documents',$common->licenseDocLink())@endcomponent

    @component('components.info.documents',$common->accreditationDocLink())@endcomponent

    @component('components.info.founder',$founder->template())@endcomponent

    @component('components.info.places',$common->places('addressPlaceSet')) @endcomponent
    @component('components.info.places',$common->places('addressPlacePrac')) @endcomponent
    @component('components.info.places',$common->places('addressPlacePodg')) @endcomponent
    @component('components.info.places',$common->places('addressPlaceGia')) @endcomponent
    @component('components.info.places',$common->places('addressPlaceDop')) @endcomponent
    @component('components.info.places',$common->places('addressPlaceOppo')) @endcomponent

@endsection


