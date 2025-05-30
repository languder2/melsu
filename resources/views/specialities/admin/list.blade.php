@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-admin.education.specialities.header />
@endsection

@section('content')

    @each('specialities.admin.section',$list,'section')

    @include('specialities.admin.section-with-parent',['list'=>$spo,'name'=>'СПО'])

    @include('specialities.admin.section-with-parent',['list'=>$pg,'name'=>'Аспирантура'])

@endsection



