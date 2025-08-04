<div class="bg-white p-4 shadow mb-4 flex gap-4 justify-between items-center">
    <div class="text-xl flex-1">
        {!! $slot !!}
    </div>

    @isset($link)
        <a
            href="{{ $link }}"
            class="
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
                flex h-8 w-8 items-center justify-center
            "
        >
            <i class="fas fa-plus w-4 py-2"></i>
        </a>
    @endisset

    @isset($info)
        {!! $info !!}
    @endisset
</div>
