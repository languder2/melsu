@props([
    'division'  => new \App\Models\Division\Division(),
    'list'      => collect(),
])

@extends("layouts.education-division")

@section('title')
    {{ $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»: $division->name" }}
@endsection

@section('additional-header')
    @component('divisions.education.public.sections.header', compact('division')) @endcomponent
@endsection

@section('content')
    <div class="grid lg:grid-cols-[2fr_1fr] xl:grid-cols-[75%_auto] gap-5 px-2.5 2xl:px-0 mb-6">
        <div class="flex flex-col gap-3">
            <h2 class="font-bold text-xl md:text-3xl mb-4">
                {{ __('menu.magazine') }}
            </h2>


            <div class="grid grid-cols-3 gap-3">
                @foreach($list as $magazine)
                    <a
                        href="{{ $magazine->link }}"
                        target="_blank"
                        class="hover:underline underline-offset-2 relative aspect-[2/3] rounded-sm hover:shadow-lg hover:-mt-1 hover:mb-1 duration-150"
                    >
                        <img
                            src="{{ $magazine->image->src }}"
                            alt=""
                            class="object-fit h-full w-full select-none rounded-sm pointer-events-none"
                            data-ya-no-menu="false"
                        />
                    </a>
                @endforeach
            </div>
        </div>

        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>

@endsection



