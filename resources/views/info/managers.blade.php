@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    {{ __('info.title.managers') }}
@endsection

@section('content')

    @component('components.info.rectorate',$managers->rectorate())@endcomponent
    @component('components.info.rectorate',$managers->branches())@endcomponent

@endsection


