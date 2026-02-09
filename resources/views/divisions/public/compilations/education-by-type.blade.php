@extends("layouts.page")

@section('title', $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»")

@section('meta')
{{--    <x-common.meta :meta="$division->meta"/>--}}
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base", $active) !!}
@endsection

@section('content')

    <section class="container block ">
        <div class="mt-2 flex flex-col lg:flex-row gap-y-1 flex-wrap">
            @foreach($tabs as $code=>$tab)
                @include('divisions.public.compilations.tab-head',[
                    'name'      => $tab['name'],
                    'href'      => $tab['href'],
                    'active'    => $code === $active
                ])
            @endforeach
        </div>
    </section>

    @if(View::exists("divisions.public.compilations.$type"))
        @include("divisions.public.compilations.$type", compact('list'))
    @endif


@endsection
