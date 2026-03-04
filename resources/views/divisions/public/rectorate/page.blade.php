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

    @include('divisions.public.rectorate.staff', ['staff'=> $division->leader->staff])

    @foreach($division->publicStaffs as $staff)
        @include('divisions.public.rectorate.staff', ['staff'=> $staff->staff])
    @endforeach

@endsection
