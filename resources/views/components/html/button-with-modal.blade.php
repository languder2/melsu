@props([
    'target'        => 'button-for-form-' . \Illuminate\Support\Str::random(20),
    'question'      => null,
    'link'          => '#',
    'relation'      => null,
    'text'          => null,
    'method'        => 'get',
    'icoClass'      => 'hover:text-sky-900',
    'lucide'        => 'accessibility',
    'button'        => null,
    'buttonClass'   => 'bg-sky-900 hover:bg-blue-800',

])

<button
    popovertarget="{{ $target }}"
    class="
        rounded-md
        cursor-pointer
        outline-0
    "
>
    {!! Blade::render("<x-lucide-$lucide class='w-6 cursor-pointer $icoClass'/>") !!}
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

            <form method="POST" action="{{ $link }}">
                @csrf
                @method(mb_strtoupper($method))
                <input
                    type="submit" value="{{ $button }}"
                    class="
                    cursor-pointer
                    inline-block relative
                    py-2 px-4 text-white rounded-md shadow-md
                    shadow-gray-300
                    active:bg-gray-700
                    hover:-mt-px hover:mb-px
                    {{ $buttonClass }}
                "
                >
            </form>
        </div>
    </div>
