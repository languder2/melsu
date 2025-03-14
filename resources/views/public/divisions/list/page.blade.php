@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'divisions',null)!!}
@endsection

@section('aside')
    {!!view('public.menu.aside-tree',['menu' => $menu ?? null ])!!}
@endsection

@section('content')
    @include('public.divisions.list.search')
    <div id="UniversityStructure" class="relative">
        @include('public.divisions.list.list',compact('depth','division'))
    </div>
@endsection
