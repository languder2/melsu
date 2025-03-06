@extends("layouts.main")

@section('title', $title??'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('includes')

    @if(in_array('jquery', $includes ?? []))
        <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    @endif
    @if(in_array('data-picker', $includes ?? []))
        <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="{{asset('js/jquery-data-picker.js')}}"></script>
    @endif
@endsection

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

