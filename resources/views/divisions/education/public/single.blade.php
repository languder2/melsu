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
        'image' => $division->image->src
    ]) @endcomponent
@endsection

@section('contacts')
    @component('divisions.education.public.sections.contacts', [
        'contacts'  => $division->contacts,
    ]) @endcomponent
@endsection

@section('content')

    <div class="grid lg:grid-cols-[2fr_1fr] xl:grid-cols-[75%_auto] gap-5 px-2.5 2xl:px-0 mb-6">
        <div class="order-2 lg:order-1 flex flex-col gap-7">
            @component('divisions.education.public.sections.about', compact('division')) @endcomponent

            @component('divisions.education.public.sections.history', compact('division')) @endcomponent

            <x-divisions.gsc :division="$division"/>

            <x-news.include-block :division="$division"/>
        </div>

        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>
@endsection



