@extends("layouts.education-division")

@section('title')
    {{ $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»: $division->name" }}
@endsection

@section('additional-header')
    @component('divisions.education.public.sections.header', compact('division')) @endcomponent
@endsection

@section('content')

    <div class="grid lg:grid-cols-[2fr_1fr] xl:grid-cols-[75%_auto] gap-5 px-2.5 2xl:px-0 mb-6">
        <div class="order-2 lg:order-1 flex flex-col gap-7">
            <x-divisions.list-in-blocks
                :list="$division->faculties"
            >
                {{ __('common.faculties') }}
            </x-divisions.list-in-blocks>

            <x-divisions.list-in-blocks
                :list="$division->subsTree()->filter(fn($item) => $item->type === \App\Enums\DivisionType::Department)"
            >
                {{ __('common.department') }}
            </x-divisions.list-in-blocks>

            <x-divisions.list-in-blocks
                :list="$division->subsTree()->filter(fn($item) => $item->type === \App\Enums\DivisionType::Lab)"
            >
                {{ __('common.labs') }}
            </x-divisions.list-in-blocks>

            <x-divisions.list-in-blocks
                :list="$division->subsTree()->filter(fn($item) => $item->type === \App\Enums\DivisionType::EducationLab)"
            >
                {{ __('common.education-labs') }}
            </x-divisions.list-in-blocks>

{{--            <div>--}}
{{--                <x-divisions.structure--}}
{{--                    :division="$division->id"--}}
{{--                >--}}
{{--                    Структура--}}
{{--                </x-divisions.structure>--}}
{{--            </div>--}}

            <x-news.include-block :division="$division"/>


        </div>

        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>
@endsection



