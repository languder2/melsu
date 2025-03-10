@extends("layouts.admin")

@section('title', 'Админ панель: Кафедры')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    @include('admin.education.departments.header')
@endsection

@section('content')
    @foreach($faculties as $faculty)
        @include('admin.education.departments.list-block',[
            'faculty'   => $faculty,
            'list'      => $faculty->departments,
        ])
    @endforeach

    @if($departments->count())
        @include('admin.education.departments.list-block',[
            'faculty'   => null,
            'list'      => $departments,
        ])
    @endif

@endsection



