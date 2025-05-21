@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет": '.$current->name)

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'cluster',$current)!!}
@endsection

@section('content')
    <div class="container">

        @if($current->cluster->preview ?? null)
            <img
                src="{{ $current->preview->src }}"
                alt="{{ $current->name }}"
                class="w-full"
            >
        @endif

        @component('projects.includes.public.contacts')@endcomponent

    </div>

    <div class="container grid grid-cols-1 lg:grid-cols-[2fr_5fr] gap-4 py-6">

        <div class="flex flex-col gap-4">
            <h4 class="border-b border-b-black text-lg text-center">
                Проекты
            </h4>

            @foreach($current->publicProjects() as $project)
                @component('projects.clusters.public.includes.project',compact("project")) @endcomponent
            @endforeach

            @if($current->publicProjects()->isEmpty())
                <img src="{{ asset('img/plugs/c1.gif') }}" alt="under construct"/>
            @endif


        </div>

        <div class="flex flex-col gap-4">
            <h4 class="border-b border-b-black text-lg text-center">
                О кластере
            </h4>
            @if($current->getContentsCount())

                @if($current->relevance)
                    @component('projects.clusters.public.includes.content',[
                        'item'      => $current->relevance(),
                        'open'      => $current->isOpen()
                    ]) @endcomponent
                @endif

                @if($current->goals)
                    @component('projects.clusters.public.includes.content',[
                        'item'      => $current->goals(),
                        'open'      => $current->isOpen()
                    ]) @endcomponent
                @endif

                @if($current->structure)
                    @component('projects.clusters.public.includes.content',[
                        'item'      => $current->structure(),
                        'open'      => $current->isOpen()
                    ]) @endcomponent
                @endif

                @if($current->suggestions)
                    @component('projects.clusters.public.includes.content',[
                        'item'      => $current->suggestions(),
                        'open'      => $current->isOpen()
                    ]) @endcomponent
                @endif

                @if($current->availableResources)
                    @component('projects.clusters.public.includes.content',[
                        'item'      => $current->availableResources(),
                        'open'      => $current->isOpen()
                    ]) @endcomponent
                @endif
            @else
                <img src="{{ asset('img/plugs/c1.gif') }}" alt="under construct"/>
            @endif


        </div>

        {{--        <div class="flex flex-col gap-4">--}}
        {{--            <h4 class="border-b border-b-black text-lg text-center">--}}
        {{--                Медиа--}}
        {{--            </h4>--}}

        {{--            <img src="{{ asset('img/clusters/image-0.jpg') }}" alt=""/>--}}
        {{--            <img src="{{ asset('img/clusters/image-1.jpg') }}" alt=""/>--}}
        {{--            <img src="{{ asset('img/clusters/image-2.jpg') }}" alt=""/>--}}
        {{--        </div>--}}
    </div>

@endsection
