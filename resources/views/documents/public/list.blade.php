@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет": Документы')

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'documents',null)!!}
@endsection

@section('aside')
    @include('public.menu.aside-tree',['menu' => $menu ?? null ])
@endsection

@section('content')

    @component('documents.public.categories', ['categories' => $categories]) @endcomponent

@endsection
