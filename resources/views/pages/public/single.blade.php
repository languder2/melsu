@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'pages',$page)}}
@endsection

@if($menu)
    @section('aside')
        @component('public.menu.aside-tree',compact('menu'))@endcomponent
    {{--    {{view('public.menu.aside-tree',['menu' => $menu ?? null ])}}--}}
    @endsection
@endif


@section('content')
    {!! $page->content_html !!}

    @component('divisions.public.includes.documents',['categories' => $page->public_document_categories]) @endcomponent

@endsection
