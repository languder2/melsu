@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ: Кадровый состав"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'staff',$staff)}}
@endsection

@section('aside')
    {{view('public.menu.aside-tree',['menu' => $menu ?? null ])}}
@endsection

@section('content')
    <x-staff.single :staff="$staff" />
@endsection



