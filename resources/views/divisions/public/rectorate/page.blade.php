@props([
    'division'      => new \App\Models\Division\Division(),
    'menu'          => null,
])

@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {!!Breadcrumbs::view("vendor.breadcrumbs.base",'division',$division)!!}
@endsection


@section('aside')
    @component('public.menu.aside-tree', compact('menu'))@endcomponent
@endsection


@section('content')

    @include('divisions.public.rectorate.staff', ['staff'=> $division->leader])

    @foreach($division->staffs as $staff)
        @include('divisions.public.rectorate.staff',['staff'=>$staff->card,'post'=>$staff->post])
    @endforeach

@endsection
