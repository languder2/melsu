@extends("layouts.page")

@section('title', 'История за ' . $history->year . ' - ФГБОУ ВО "Мелитопольский государственный университет"')

@section('content')
    <div class="container px-2.5 2xl:px-0 overflow-hidden">
        <nav class="my-4">
            <a href="{{ route('public.history.index') }}" class="flex items-center gap-2 group hover:text-[#C10F1A] transition duration-300 ease-linear">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="bi bi-arrow-left-circle-fill fill-[#820000] group-hover:fill-[#C10F1A] transition duration-300 ease-linear" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg>
                </span>
                <span>
                    Назад
                </span>
            </a>
        </nav>
        @if($history->image)
        <div class="h-64 bg-cover bg-center" style="background-image: url('{{ Storage::url($history->image) }}')"></div>
        @endif
        
        <div class="p-5 flex flex-col gap-3">
            <div>
                <span class="inline-block bg-[#820000] text-white px-4 py-2 rounded text-lg font-bold">
                    {{ $history->year }}
                </span>
            </div>
            
            <h1 class="text-3xl font-bold">
                {!! $history->description !!}
            </h1>
            
            <div class="prose">
                {!! $history->content !!}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-5">
            @if($previous)
                <a href="{{ route('public.history.show', $previous->id)}}"
                class="flex gap-3 items-center bg-white p-5 hover:bg-[#C10F1A] hover:text-white transition duration-300 ease-linear">
                    <div class="rounded-[100%] overflow-hidden w-[100px] h-[100px]">
                        <img class="h-full" src="{{Storage::url($previous->image)}}" alt="">
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-bold">
                            {{ $previous->year }}
                        </span>
                        <span>
                            {!! $previous->description !!}
                        </span>
                    </div>
                </a>
            @else
            @endif

            @if($next)
                <a href="{{ route('public.history.show', $next->id)}}"
                class="flex gap-3 items-center bg-white p-5 hover:bg-[#C10F1A] hover:text-white transition duration-300 ease-linear">
                    <div class="rounded-[100%] overflow-hidden w-[100px] h-[100px]">
                        <img class="h-full" src="{{Storage::url($next->image)}}" alt="">
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-bold">
                            {{ $next->year }}
                        </span>
                        <span>
                            {!! $next->description !!}
                        </span>
                    </div>
                </a>
            @else
            @endif
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.my-6').style.display = 'none';
        document.querySelector('.main-content').style.padding = '0px';
    });
</script>