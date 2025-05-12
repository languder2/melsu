@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет": '.$current->name)

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'cluster',$current)!!}
@endsection

@section('content')
    <div class="container">

        <img
            src="{{ $current->preview->src }}"
            alt="{{ $current->name }}"
            class="w-full"
        >
        <div class="grid gap-4 grid-cols-[auto_1fr_1fr]">

            <img src="{{asset('img/clusters/photo.jpg')}}" alt=""/>

            <div class="py-6">
                <div class="grid grid-cols-[auto_1fr] gap-4 items-center">
                    <img src="{{ asset('img/clusters/ico-1.svg') }}" alt=""/>
                    <div>
                        <span class="font-semibold">Короткая Ирина Александровна</span>
                        <p>
                            к.с-х.н., доцент, декан Агротехнологического факультета
                        </p>
                    </div>

                    <img src="{{ asset('img/clusters/ico-2.svg') }}" alt=""/>
                    <div>
                        example.mail@gsox.vok
                    </div>

                    <img src="{{ asset('img/clusters/ico-3.svg') }}" alt=""/>
                    <div>
                        +7 (990) 000-06-66
                    </div>

                    <img src="{{ asset('img/clusters/ico-4.svg') }}" alt=""/>
                    <div>
                        https://melsu.ru
                    </div>

                    <img src="{{ asset('img/clusters/ico-5.svg') }}" alt=""/>
                    <div>
                        Имеющиеся ресурсы: сельхозтехника: 1 комбайн, 12 тракторов, с/х оборудование
                    </div>
                </div>
            </div>

            <div class="py-6 flex flex-col gap-4">
                {!! $current->full !!}
            </div>

        </div>


    </div>

    <div class="container grid grid-cols-1 lg:grid-cols-[2fr_3fr_2fr] gap-4 py-6">

        <div class="flex flex-col gap-4">
            <h4 class="border-b border-b-black text-lg text-center">
                Проекты
            </h4>
        </div>

        <div class="flex flex-col gap-4">
            <h4 class="border-b border-b-black text-lg text-center">
                О кластере
            </h4>

            @component('projects.clusters.public.includes.content',[
                'item'      => $current->relevance()
            ]) @endcomponent

            @component('projects.clusters.public.includes.content',[
                'item'      => $current->goals()
            ]) @endcomponent

            @component('projects.clusters.public.includes.content',[
                'item'      => $current->structure()
            ]) @endcomponent

            @component('projects.clusters.public.includes.content',[
                'item'      => $current->suggestions()
            ]) @endcomponent

        </div>

        <div class="flex flex-col gap-4">
            <h4 class="border-b border-b-black text-lg text-center">
                Медиа
            </h4>

            <img src="{{ asset('img/clusters/image-0.jpg') }}" alt=""/>
            <img src="{{ asset('img/clusters/image-1.jpg') }}" alt=""/>
            <img src="{{ asset('img/clusters/image-2.jpg') }}" alt=""/>
        </div>
    </div>

@endsection
