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
                <h4 class="font-semibold py-4 text-xl">
                    Деканат
                </h4>
                <div class="employees-about">
                    <div class="employees-box grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-2">
                        @isset($division->chief->card)
                            <div class="bg-white p-3">
                                <span>{{$division->chief->card->full_name}}</span>
                            </div>
                            <div class="bg-white p-3 flex items-center">
                        <span class="ps-3 lg:ps-0">
                            {{$division->chief->post}}
                        </span>
                            </div>
                        @endisset
                        @foreach($division->staffs as $staff)
                            <div class="bg-white p-3">
                                <span>{{$staff->card->full_name}}</span>
                            </div>
                            <div class="bg-white p-3 flex items-center">
                                <span class="ps-3 lg:ps-0">
                                    {{$staff->post}}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @break

            @case('teaching-staff')
                <h4 class="font-semibold py-4 text-xl">
                    Педагогический состав
                </h4>
                <div class="employees-about">
                    <div class="employees-box grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-2">

                        @foreach($division->TeachingStaff as $full_name=>$staff)
                            <div class="bg-white p-3">
                                <span>{{$full_name}}</span>
                            </div>
                            <div class="bg-white p-3 flex flex-col gap-4 ps-6 lg:ps-3">
                                @foreach($staff->posts as $post)
                                    <div>
                                        {{$post}}
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

                    </div>
                </div>
            @break

            @case('specialities')
                <x-specialities.all-speciality
                    :division="$division"
                />
            @break

            @default
                <div class="flex flex-col gap-4 mb-4">
                    @each('public.page.content-section',$division->sections,'section')
                </div>
        @endswitch
    </section>
@endsection



