@extends("layouts.page")

@section('title')
    ФГБОУ ВО "МелГУ: {!! $division->name    !!}
@endsection

@section('breadcrumbs')

    {{Breadcrumbs::view("vendor.breadcrumbs.base",$division->type->value,$division)}}
@endsection

@section('aside')
    @include('public.menu.education')
@endsection

@section('content')

    <section class="container px-2 pb-8">


        @switch($section)
            @case('news')
            @break

            @default @include('public.staffs.division.chief')

        @endswitch


        <div class="horizontal-mob-menu">
            @include('public.menu.education')
        </div>

        @switch($section)
            @case('labs') @case('departments')
                @include('public.education.departments.related')
            @break

            @case('faculties')
                @include('public.education.faculties.related')
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

            @case('news')
                @if($division->getNewsCollection()->find($op))
                    @component('news.public.relations.item',['news' => $division->getNewsCollection()->find($op)])@endcomponent
                @else
                    @component('news.public.relations.for-education',['list' => $division->getNewsCollection()])@endcomponent
                @endif
            @break

                @case('upbringing')
                    @php
                        $sections = $division->upbringingSections->where('show', true)->sortBy('order');
                    @endphp
                    <h4 class="font-semibold py-6 text-xl">
                        Воспитательная работа
                    </h4>
                    <div class="flex flex-col gap-4 mb-4">
                        @each('public.page.content-section', $sections, 'section')
                    </div>
                    @break
                @case('partner')
                    @php
                        $sections = $division->partnerSections->where('show', true)->sortBy('order');
                    @endphp
                    <h4 class="font-semibold py-6 text-xl">
                        Партнеры
                    </h4>
                    <div class="flex flex-col gap-4 mb-4">
                        @each('public.page.content-section', $sections, 'section')
                    </div>
                    @break

            @default
                @if($division->publicSections->count())
                    <div class="flex flex-col gap-4 mb-4">
                        @each('public.page.content-section',$division->publicSections,'section')
                    </div>
                @else
                    <div class="bg-white p-6">
                        {!! $division->description !!}
                    </div>
                @endif
        @endswitch
    </section>
@endsection



