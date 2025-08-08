@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {!!Breadcrumbs::view("vendor.breadcrumbs.base",'division',$division)!!}
@endsection

@section('aside')
    {!!view('public.menu.aside-tree',['menu' => $menu ?? null ])!!}
@endsection

@section('content')

    @if(!in_array($division->code,['academic-council']))
        @include('public.staffs.division.chief')
    @endif

    @if($division->sections->count())
        <div class="flex flex-col gap-3">
            @each('public.page.content-section',$division->sections,'section')
        </div>
    @endif

    @component('public.divisions.includes.documents',['categories' => $division->documentCategories]) @endcomponent


    @component('public.staffs.division.staffs',[
        'staffs'    => $division->staffs(true)->get(),
        'full_post' => in_array($division->code,['academic-council'])
    ])
        @slot('title')
            @if($division->code === 'academic-council')
                Состав ученого совета
            @else
                Сотрудники
            @endif
        @endslot
    @endcomponent

@endsection
