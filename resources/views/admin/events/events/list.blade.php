@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.events.menu')
@endsection

@section('content-header')
    @component("components.html.admin.content-header",[
        'link'  => route('admin:events:add')
    ])
        Мероприятия
    @endcomponent
@endsection

@section('content')

@endsection



