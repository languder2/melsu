@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'departments',null)}}
@endsection


@section('sidebar')
    {{view('public.menu.aside-tree',['menu' => $menu ?? null ])}}
@endsection


@section('content-without-bg')
    @include('public.departments.search')
    <div id="UniversityStructure" class="relative">
        @include('public.departments.list',compact('depth','department'))
    </div>
@endsection



