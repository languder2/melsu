@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ: Кадровый состав"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'staffs',null)}}
@endsection

@section('aside')
    {{view('public.menu.aside-tree',['menu' => $menu ?? null ])}}
@endsection


@section('content')
    @include('public.staffs.staffs.search')

    <div id="PersonnelStructure">
        @include('public.staffs.staffs.list',compact('staffs'))
    </div>
@endsection



