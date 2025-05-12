<div class="content-block open:bg-green-700 group">
    <a
        href="#"
        class="content-block cursor-pointer hover:bg-stone-100 font-semibold text-xl flex gap-3 justify-between items-center"
        onclick="this.closest('.content-block').toggleAttribute('open'); return false;"
    >
        {{ $item->getName() }}
        <i class="fas fa-chevron-up"></i>
    </a>
    <div class="content-text">
        {!! $item->content !!}
    </div>
</div>
