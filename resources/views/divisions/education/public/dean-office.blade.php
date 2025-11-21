@extends("layouts.education-division")

@section('title')
    {{ $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»: $division->name:" .__('menu.dean office') }}
@endsection

@section('additional-header')
    @component('divisions.education.public.sections.header-without-contacts', compact('division')) @endcomponent
@endsection

@section('content')

    <div class="grid lg:grid-cols-[2fr_1fr] xl:grid-cols-[75%_auto] gap-5 px-2.5 2xl:px-0 mb-6">
        <div class="flex flex-col gap-7">
            <h2 class="font-bold text-xl md:text-3xl">
                {{ __('menu.dean office') }}
            </h2>

            @component('divisions.education.public.sections.chief', compact('division')) @endcomponent

            @component('divisions.education.public.sections.employees',[
                'staffs'    => $division->staffs,
                'title'     => 'Сотрудники'
            ])@endcomponent

            <x-news.include-block :division="$division"/>
        </div>

        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>
@endsection



