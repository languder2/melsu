<a
    href="{{ $link ?? null }}"

    @isset($block)
        onclick="Actions.DeleteSection(this,'.{{$block}}'); return false;"
    @endif

    title="удалить"

    class="
        inline-block
        bg-gray-100 px-3 py-2 rounded-lg
        transition-all duration-200
        hover:text-white hover:bg-red-700
        hover:-mt-2px hover:mb-2px
        hover:shadow-md hover:shadow-gray-400
    "
>
    <i class="fas fa-recycle"></i>
</a>
