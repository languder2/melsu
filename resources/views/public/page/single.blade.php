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

    @if($page->view)
        @include("pages.content.{$page->view}")
    @else

        @if($page->content)
            <div
                @class([
                    $page->without_bg?'':'bg-white p-4'
                ])
            >
                {!! $page->content !!}
            </div>
        @endif

        @if($page->sections->count())
            <div class="flex flex-col gap-4">
                @each('public.page.content-section',$page->sections,'section')
            </div>
        @endif

        @component('divisions.public.includes.documents',['categories' => $page->public_document_categories]) @endcomponent

    @endif


@endsection
