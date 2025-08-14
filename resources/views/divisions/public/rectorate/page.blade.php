@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {!!Breadcrumbs::view("vendor.breadcrumbs.base",'division',$division)!!}
@endsection


@section('aside')
    {!!view('public.menu.aside-tree',['menu' => $menu ?? null ])!!}
@endsection


@section('content')

    @include('divisions.public.rectorate.staff',['staff'=>$division->chief->card])

    @foreach($division->staffs as $staff)
        @include('divisions.public.rectorate.staff',['staff'=>$staff->card,'post'=>$staff->post])
    @endforeach

@endsection
