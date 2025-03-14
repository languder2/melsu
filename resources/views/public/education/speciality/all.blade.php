@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ": Направления подготовки')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'specialities',null)}}
@endsection

@section('aside')
    @component('public.menu.aside-tree',compact('menu')) @endcomponent
@endsection

@section('content')
    <x-specialities.all-speciality />
@endsection


