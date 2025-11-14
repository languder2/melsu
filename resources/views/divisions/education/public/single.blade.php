@extends("layouts.education-division")

@section('title')
    {{ $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»: $division->name" }}
@endsection

{{--@section('breadcrumbs')--}}
{{--    {{Breadcrumbs::view("vendor.breadcrumbs.base",$division->type->value,$division)}}--}}
{{--@endsection--}}

@section('additional-header')
    @component('divisions.education.public.sections.header', [
        'name'  => $division->name,
        'image' => "img/faculties-headers/$division->code.webp"
    ]) @endcomponent
@endsection

@section('contacts')
    @component('divisions.education.public.sections.contacts', [
        'contacts'  => $division->contacts,
    ]) @endcomponent
@endsection

@section('content')

    <div class="grid lg:grid-cols-[2fr_1fr] xl:grid-cols-[75%_auto] gap-5 px-2.5 2xl:px-0">
        <div class="order-2 lg:order-1 flex flex-col gap-7">
            @component('divisions.education.public.sections.about', compact('division')) @endcomponent
            @component('divisions.education.public.sections.goals-and-specialities', compact('division')) @endcomponent
        </div>
        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>


    <section class="container px-2 pb-8 hidden">
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
                    @slot('title')
                        Деканат
                    @endslot
                @endcomponent
                @break

            @case('teaching-staff')
                @component('public.staffs.division.staffs',[
                    'staffs'    => $division->TeachingStaff
                ])
                    @slot('title')
                        Педагогический состав
                    @endslot
                @endcomponent
                @break

            @case('specialities')
                <x-specialities.all-speciality
                    :division="$division"
                />
                @break

            @case('news')
                <x-news.include-block :division="$division"/>
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

                @if($division->content)
                    <div class="content-news mb-3 codex-editor flex flex-col gap-4">
                        {!! $division->contentHTML !!}
                    </div>
                @elseif($division->publicSections->count())
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



