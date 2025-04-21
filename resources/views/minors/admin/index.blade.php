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
            "
        >
            <img src="{{asset('img/Pobeda80.png')}}" alt="regiments" class="max-h-60">
            {{__('regiment.Immortal and Scientific Regiment')}}
        </a>
    </div>

@endsection
