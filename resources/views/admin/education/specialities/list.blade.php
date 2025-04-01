@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-admin.education.specialities.header />
@endsection

@section('content')

    @each('admin.education.specialities.section',$list,'section')

{{--    @include('admin.education.specialities.section',['list'=>$spo,'name'=>'СПО'])--}}

@endsection



