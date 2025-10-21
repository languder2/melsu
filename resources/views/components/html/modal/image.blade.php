@props([
    'url',
    'id'    =>  'modal-img-' . microtime(true) . '-' . mt_rand(1, 100),
    'open'  => false,
    "object" => 'object-contain'
])

<button popovertarget="{{ $id }}" {{ $attributes }} @if($open) open @endif>
    <img src="{{$url}}" alt="" class="h-full w-full {{ $object }} focus:outline-none">
</button>
<div
    popover
    id="{{ $id }}"
    class="
        fixed inset-0
        starting:open:opacity-0 open:backdrop-brightness-50
        transition-opacity duration-300
        bg-black/80
    "
>
    <button
        popovertarget="{{ $id }}"
        popovertargetaction="hide"
        class="
            h-screen
            w-screen
            p-4
            flex items-center justify-center
            focus:outline-none
            cursor-pointer
        "
    >
            <img
                src="{{$url}}"
                alt=""
                class="
                    w-full h-full
                    object-contain
                    drop-shadow-md drop-shadow-white
            "
            >
    </button>
</div>

