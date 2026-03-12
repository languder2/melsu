@props([
    'list'  => collect()
])
@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'divisions',null)!!}
@endsection

@section('aside')
    @component('public.menu.aside-tree',['menu' => $menu ?? null ]) @endcomponent
@endsection

@section('content')
    @include('public.divisions.list.search')

    <div class="flex flex-col gap-3">
        @each('divisions.public.list-item', $list, 'division')
    </div>

@endsection
