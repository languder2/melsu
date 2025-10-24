@extends("layouts.page")

@section('title', 'Флагманские проекты')

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'clusters',null)!!}
    <div class="container hidden lg:block text-3xl opacity-50">
        Мелитопольского Государственного Университета
    </div>
@endsection

@section('content')
    <section class="container">

        @include('projects.clusters.public.includes.intro')

        @include('projects.clusters.public.includes.collage')

    </section>

    <div class="max-w-[96rem] mx-auto mb-10">

        <h3 class="text-3xl font-bold mb-4 pt-2 uppercase">
            Кластеры
        </h3>

        <div class="flex flex-col lg:flex-row gap-4">
            @foreach($list as $item)
                <a href="{{ $item->link }}" class="flex-1 flex flex-col gap-4 hover:text-base-red duration-300 hover:fill-base-red">

                    <x-html.svg>
                        {!! $item->ico->content !!}
                    </x-html.svg>

                    <span class="text-center font-semibold">
                        {{ $item->name }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>


    @include('projects.clusters.public.includes.strategic-projects')

@endsection
