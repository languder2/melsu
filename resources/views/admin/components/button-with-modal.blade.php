<div>
    <button
        type="button"
        popovertarget="{{ $id ?? null }}"
        class="
            p-1 rounded-md
            text-black
            hover:text-red-700
            active:text-gray-700
            cursor-pointer
        "
    >
        {!! $ico ?? '' !!}
    </button>
    <div popover=""
         id="{{ $id ?? null }}"
         class="
                        relative inset-y-0 mx-auto my-auto
                        transform overflow-hidden
                        rounded-lg bg-white text-left
                        opacity-0 shadow-xl transition-all [transition-behavior:allow-discrete] duration-300
                        sm:w-full sm:max-w-600 [&:is([open],:popover-open)]:opacity-100
                        [@starting-style]:[&:is([open],:popover-open)]:opacity-0
                    "

    >
        <h3 class="p-4 font-semibold">
            {{ $question ?? '' }}
        </h3>
        <hr>
        <div class="p-4">

            @if($show_link)
                <a href="{{ $show_link }}" target="_blank" class="underline hover:text-red">
                    {!! $detail !!}
                </a>
            @else
                {{ $detail ?? '' }}
            @endif
        </div>
        <hr>
        <div class="text-right p-4">
            <a
                href="{{ $link ?? '#' }}"
                class="
                    inline-block relative
                    py-2 px-4 text-white rounded-md shadow-md
                    shadow-gray-300
                    bg-red-800 hover:bg-red-700 active:bg-gray-700
                    hover:-mt-px hover:mb-px
                "
                onclick="{{$onclick ?? ''}}"
            >
                удалить
            </a>
        </div>
    </div>

</div>
