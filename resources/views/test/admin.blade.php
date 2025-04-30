@extends("layouts.admin")

@section('title', 'Админ панель: Документы')

@section('top-menu')
{{--    @include('documents.admin-menu')--}}
@endsection

@section('content-header')

@endsection

@section('content')


    @component('news.admin.include')@endcomponent



@endsection
