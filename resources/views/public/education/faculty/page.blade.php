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

        @switch($section)
            @case('departments')
                @include('public.education.departments.related')
            @break

            @case('dean-office')
                @component('public.staffs.division.staffs',[
                    'staffs'    => $division->staffs
                ])
                    @slot('title') Деканат @endslot
                @endcomponent
            @break

            @case('teaching-staff')
                @component('public.staffs.division.staffs',[
                    'staffs'    => $division->TeachingStaff
                ])
                    @slot('title') Педагогический состав @endslot
                @endcomponent
            @break

            @case('specialities')
                <x-specialities.all-speciality
                    :division="$division"
                />
            @break

{{--            @case('news')--}}
{{--                @dd(3)--}}
{{--                @include('public.education.departments.related')--}}
{{--            @break--}}


            @default
                <div class="flex flex-col gap-4 mb-4">
                    @each('public.page.content-section',$division->sections,'section')
                </div>
        @endswitch
    </section>
@endsection



