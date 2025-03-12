@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-admin.education.specialities.header />
@endsection

@section('content')
    <x-admin.education.specialities.list
        :list="$list   "
    />
@endsection



