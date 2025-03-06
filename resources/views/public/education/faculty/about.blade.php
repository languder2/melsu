@extends("layouts.page")

@section('title')
    ФГБОУ ВО "МелГУ: {{$faculty->name}}
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'faculty',$faculty)}}
@endsection

@section('sidebar')
    @include('public.menu.aside',['menu' => $menu ?? null ])
@endsection

@section('content-without-bg')
    @if($faculty->department)
        @each('public.page.content-section',$faculty->department->sections,'section')
    @endif
@endsection



