@props([
    'info'  => new \App\Models\Info\InfoBase()
])
<div class="flex flex-col sticky top-0 bottom-0">
    @guest
        <a
            href="{{ route('info:login') }}"
            class="flex gap-2 items-center px-6 py-3 hover:bg-white hover:text-black justify-end text-gray-100 "
        >
            Авторизироваться
            <x-lucide-log-in class="w-6"/>
        </a>
    @else
        <a
            href="{{ route('info:exit') }}"
            class="flex gap-2 items-center px-6 py-3 hover:bg-white hover:text-black justify-end text-gray-100 "
        >
            Выход
            <x-lucide-log-out class="w-6" />
        </a>
    @endguest
    <hr class="my-1">
    @foreach($info->getMenu() as $item)
        <a
            href="{{ $item->href }}"
            @class([
                "
                    px-6 py-3
                    hover:bg-white
                    hover:text-black
                ",
                $item->active ? "pointer-events-none bg-stone-100 text-black" : "text-gray-100"
            ])
        >
            {{ $item->label }}
        </a>
    @endforeach
    @if(auth()->check())
        <a
            href="{{ route('info:education:summary') }}"
            @class([
                "
                    px-6 py-3
                    hover:bg-white
                    hover:text-black
                    text-gray-100
                ",
            ])
        >
            Образование. Сводная
        </a>
    @endif
</div>
