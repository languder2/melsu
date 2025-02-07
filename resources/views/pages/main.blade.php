@extends('layouts.main')

{{--@section('title', 'ФГБОУ ВО "МелГУ"')--}}

@section('content')
    <x-slider.mainpage />

    <x-sections.melsu-today />

    <x-news.short-news />

    <x-sections.melsu-numbers />

    <x-sections.map />
@endsection
