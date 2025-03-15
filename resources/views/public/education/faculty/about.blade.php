@extends("layouts.page")

@section('title')
    ФГБОУ ВО "МелГУ: {{$division->name}}
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'faculty',$division)}}
@endsection

@section('aside')
    @include('public.menu.education')
@endsection

@section('content')
    <section class="container px-2">

        @include('public.staffs.division.chief')

        <div class="flex flex-col gap-4 mb-4">
            @each('public.page.content-section',$division->sections,'section')
        </div>

    </section>
@endsection



