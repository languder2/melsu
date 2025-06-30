@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {!! $structure->pageTitle !!}
@endsection

@section('content')

    @component('components.info.structure',$structure->divisions()) @endcomponent
    @component('components.info.structure',$structure->branches()) @endcomponent
    @component('components.info.structure',$structure->representative()) @endcomponent

@endsection


