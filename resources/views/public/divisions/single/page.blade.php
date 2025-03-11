@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'division',$division)}}
@endsection

@section('sidebar')
    {{view('public.menu.aside-tree',['menu' => $menu ?? null ])}}
@endsection

@section('content-without-bg')

    @isset($division->chief->card)
        <div class="bg-white p-6 sm:min-h-40 flex flex-col justify-between mb-3">
            <div class="mb-7 sm:mb-0">
                <a href="{{$division->chief->link}}" class="font-bold text-2xl mb-5 block">
                    {{$division->chief->full_name}}
                </a>
                <div class="flex flex-col sm:flex-row mb-3">
            <span class="text-[#4C4C4C] text-lg">
                Должность:
            </span>
                    <span class="text-[var(--secondary-color)] text-lg pt-3 sm:pl-3 sm:pt-0">
                {{$division->chief_post}}
            </span>
                </div>
            </div>

            <div class="flex justify-between flex-col sm:flex-row mb-7 sm:mb-0">
                <div class="w-[100%] mb-7 sm:mb-0">
                <span class="text-[#4C4C4C] text-lg">
                    Адрес:
                </span>
                    <p class="font-semibold text-lg text-[#4C4C4C]">
                        корпус 9, каб. 224
                    </p>
                </div>
                <div class="w-[100%]">
            <span class="text-[#4C4C4C] text-lg">
                Телефон:
            </span>
                    <p class="font-semibold text-lg text-[#4C4C4C]">
                        +7 (990) XXX-XX-XX
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if($division->sections->count())
        @foreach($division->sections as $section)
            <div class="about-otdel">
                @if($section->show_title)
                    <h2 class="font-bold text-xl my-6 uppercase">
                        {{$section->title}}
                    </h2>
                @endif
                <div class="bg-white p-6 mb-5">
                    {!! $section->content !!}
                </div>
            </div>
        @endforeach
    @endif

    @if($division->staffs->count())
        <div class="employees-about">
            <h2 class="font-bold text-xl my-6 text-end uppercase">Сотрудники</h2>
            <div class="employees-box grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-2">
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
    @endif
@endsection
