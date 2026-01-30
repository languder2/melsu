@props([
    'target'    => 'link-for-delete-' . \Illuminate\Support\Str::random(20),
    'question'  => 'Удалить запись',
    'action'    => '#',
    'relation'  => null,
    'text'      => null,
    'method'    => 'delete',
    'icoClass'  => 'text-amber-600'
])

<button
    popovertarget="{{ $target }}"
    class="
        rounded-md
        cursor-pointer
        outline-0
    "
>
    <x-lucide-trash-2 class="w-6 cursor-pointer {{ $icoClass }}"/>
</button>

<div
    popover=""
    id="{{ $target }}"
    class="
        fixed m-auto lg:min-w-100 lg:max-w-150
        transform overflow-hidden
        text-left
        opacity-0 shadow-xl transition-all [transition-behavior:allow-discrete] duration-300
        [&:is([open],:popover-open)]:opacity-100
        [@starting-style]:[&:is([open],:popover-open)]:opacity-0
        backdrop:bg-black/40 rounded-lg
    "
>
        <h3 class="p-4 font-semibold">
            {{ mb_ucfirst($question) }}
        </h3>
        <hr>
        <div class="p-4 flex flex-col gap-3">
            @if($relation)
                <div>
                    {!! $relation !!}
                </div>
            @endif

            <div>
                {!! $text !!}
            </div>

        </div>
        <hr>
        <div class="text-right px-4 py-2">

            <form method="POST" action="{{ $action }}">
                @csrf
                @method(mb_strtoupper($method))
                <input
                    type="submit" value="удалить"
                    class="
                    cursor-pointer
                    inline-block relative
                    py-2 px-4 text-white rounded-md shadow-md
                    shadow-gray-300
                    bg-red-800 hover:bg-red-700 active:bg-gray-700
                    hover:-mt-px hover:mb-px
                "
                >
            </form>
        </div>
    </div>
