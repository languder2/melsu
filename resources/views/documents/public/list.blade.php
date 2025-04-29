@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет": Документы')

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'documents',null)!!}
@endsection

@section('aside')
    @include('public.menu.aside-tree',['menu' => $menu ?? null ])
@endsection

@section('content')
<div class="flex flex-col gap-4 ul-correct">
    @each('documents.public.category',$categories,'category')
</div>

@endsection
