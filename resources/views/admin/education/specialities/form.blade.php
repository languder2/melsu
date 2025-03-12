@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-admin.education.specialities.header />
@endsection

@section('content')
    <x-admin.education.specialities.form.form
        :current="$current"
        :add2faculty="$add2faculty"
        :faculties="$faculties"
        :faculties2="$faculties"
        :departments="$departments"
        :departments2="$departments"
        :levels="$levels"
    />
@endsection



