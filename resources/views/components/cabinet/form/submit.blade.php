<div class="text-center @isset($blockCalles) {!! $blockCalles !!} @endisset">
    <input
        name    = "{{ $name ?? "submit" }}"
        type    = "{{ $type ?? "submit" }}"
        value   = "{{ $slot ?? "submit" }}"
        onclick = "{{ $onclick ?? null }}"
        class   = "
            font-semibold text-white bg-blue py-2 px-4 min-w-50 rounded-lg
            hover:bg-blue-hover
            active:bg-neutral-600
        "
    >
</div>
