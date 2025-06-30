<div class="flex flex-col py-2 h-screen">
    <div class="content-header text-2xl border-b border-b-white p-4 pb-2 mb-2">
        <a href="{{ url('/') }}" class="text-white flex gap-4 items-center">
            <img src="{{asset('img/cabinet/logo.svg')}}" alt="" class="h-10" /> Главная
        </a>
    </div>

    @foreach($info->getMenu() as $item)
        <a
            href="{{ $item->href }}"
            @class([
                "
                    px-6 py-3
                    text-gray-100
                    hover:bg-stone-200
                    hover:text-black
                ",
                $item->active ? "pointer-events-none bg-stone-100 text-red" : ""
            ])
        >
            {{ $item->label }}
        </a>
    @endforeach
    <div class="flex-grow"></div>
    <div>
        &copy; 2025 ФГБОУ ВО "МелГу"
    </div>
</div>
