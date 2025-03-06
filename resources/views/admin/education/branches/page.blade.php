@extends("layouts.admin")

@section('title', 'Админ панель: Филиалы')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-html.admin.content-header
        :link="route('admin:education:branches:add')"
    >
        Филиалы
    </x-html.admin.content-header>
@endsection

@section('content')
    branches content 123
@endsection



