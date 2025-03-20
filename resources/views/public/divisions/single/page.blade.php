@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {!!Breadcrumbs::view("vendor.breadcrumbs.base",'division',$division)!!}
@endsection

@section('aside')
    {!!view('public.menu.aside-tree',['menu' => $menu ?? null ])!!}
@endsection

@section('content')

    @include('public.staffs.division.chief')


    @if($division->sections->count())
        @foreach($division->sections as $section)
            <div class="about-otdel">
                @if($section->show_title)
                    <h2 class="font-bold text-xl my-6 uppercase">
                        {!!$section->title!!}
                    </h2>
                @endif
                <div class="bg-white p-6 mb-5">
                    {!! $section->content !!}
                </div>
            </div>
        @endforeach
    @endif

    @component('public.staffs.division.staffs',[
        'staffs'    => $division->staffs(true)->get()
    ])
        @slot('title') Сотрудники @endslot
    @endcomponent

@endsection
