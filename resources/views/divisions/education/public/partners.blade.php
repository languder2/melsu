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
                {{ __('menu.partners and graduations') }}
            </h2>

            @if($division->partnerCategories->count() > 1)
                <div class="flex gap-3 border-b border-gray-200">
                    @foreach($division->partnerCategories as $category)
                        <a
                            href="#"
                            data-category="{{ $category->id }}"
                            class=""
                        >
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @foreach($division->partnerCategories as $category)
                <div
                    data-category="{{ $category->id }}"
                    class="partnerList grid grid-cols-1 lg:grid-cols-2 gap-3 @if(!$loop->first) overflow-hidden max-h-0 @endif"
                >
                    @foreach($category->partners as $partner)
                        <a
                            href="{{ $partner->link ?? '#' }}"
                            class="flex shadow hover:-mt-1 hover:mb-1 duration-300 transition-all"
                            @empty($partner->link)
                                onclick="return false"
                            @endempty
                            target="_blank"
                        >
                            <img
                                src="{{ $partner->image->src }}"
                                alt="{{ $partner->name }}"
                                class="aspect-square object-contain max-h-20 bg-gray-200 p-1"
                            />
                            <div class="p-3 bg-white flex items-center flex-1 font-semibold">
                                {{ $partner->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach

            <x-news.include-block :division="$division"/>
        </div>

        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>
@endsection



