@extends('layouts.main')

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    <x-slider.mainpage />

    <x-sections.melsu-today />

    <x-sections.melsu-inform />

    <x-sections.melsu-numbers />

    <x-sections.map />
@endsection
