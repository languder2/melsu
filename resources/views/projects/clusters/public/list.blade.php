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

    <div class="max-w-[96rem] mx-auto -mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 bg-white">
            @foreach($list as $item)
                <a href="{{ $item->link }}"
                    class="bg-white p-6 border border-black hover:bg-red-700 hover:text-white group transition-all duration-500 "
                >
                    <div class="bg-cover bg-center flex flex-col gap-4 h-full min-h-72 group-hover:bg-opacity-0"
                         style="background-image: url('{{asset('img/clusters/Component 19.svg')}}')"
                    >
                        <h4 class="font-semibold text-xl">
                            {!! $item->name !!}
                        </h4>

                        <h4 class="">
                            {!! $item->short !!}
                        </h4>


                    </div>
                </a>
            @endforeach
        </div>
    </div>


    @include('projects.clusters.public.includes.strategic-projects')

@endsection
