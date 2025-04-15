@extends('layouts.main')

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('includes')
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="{{asset('js/jquery-data-picker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slider.js')}}"></script>
@endsection

@section('content')
    <x-slider.mainpage/>

    <x-sections.melsu-today/>

    <x-news.short-news/>

    <x-events.short-list/>

    <x-sections.melsu-numbers/>

    <x-sections.map/>
@endsection
<script src="{{asset('./js/countdown-slider.js')}}"></script>
