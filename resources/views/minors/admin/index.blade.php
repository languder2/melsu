@extends("layouts.admin")

@section('title', 'Админ панель: Список второстепенных возможностей')

@section('content')

    <div class="flex gap-4">
        <a
            href="{{route('regiment:admin:list')}}"
            class="
                flex gap-3 flex-col items-center
                bg-neutral-100 p-4 text-lg shadow-md
                group hover:bg-slate-300 hover:text-white transition-all duration-300
                hover:mb-1 hover:-mt-1
                min-w-76
            "
        >
            <img src="{{asset('img/Pobeda80.png')}}" alt="regiments" class="max-h-60">

            <p class="font-semibold">
                {{__('regiment.Regiments')}}
            </p>
        </a>

        <a
            href="{{route('documents:admin:list')}}"
            class="
                flex gap-3 flex-col items-center
                bg-neutral-100 p-4 text-lg shadow-md
                group hover:bg-slate-300 hover:text-white transition-all duration-300
                hover:mb-1 hover:-mt-1
                min-w-76
            "
        >
            <span class="flex-grow"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="60%" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
            </svg>
            <span class="flex-grow"></span>
            <p class="font-semibold">
                {{__('documents.Documents')}}
            </p>
        </a>

        <a
            href="{{ route('projects.admin') }}"

            class="
                flex gap-3 flex-col items-center
                bg-neutral-100 p-4 text-lg shadow-md
                group hover:bg-slate-300 hover:text-white transition-all duration-300
                hover:mb-1 hover:-mt-1
                min-w-76
            "
        >
            <span class="flex-grow"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="60%" viewBox="0 0 512 512">
                <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
            </svg>
            <span class="flex-grow"></span>
            <p class="font-semibold">
                {{__('projects.Projects')}}
            </p>
        </a>
    </div>
@endsection
