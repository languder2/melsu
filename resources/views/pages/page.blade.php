@extends("layouts.main")

@section('title', $title??'ФГБОУ ВО "Мелитопольский государственный университет"')

@if(isset($breadcrumbs) && is_object($breadcrumbs))
    @section('breadcrumbs')
        {{Breadcrumbs::view(
            "vendor.breadcrumbs.".($breadcrumbs->view??'base'),
            $breadcrumbs->route,
            $breadcrumbs->element
        )}}
    @endsection
@endif

@section('content')
    @if(is_array(@$contents))
        @foreach($contents as $content)
            {!! $content !!}
        @endforeach
    @endif
@endsection

