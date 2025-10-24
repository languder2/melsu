@props([
    "item"  => new \App\Models\Services\Content(),
    'open'  => false

])

@if($item->content)
    <div @if($open ?? null) open @endif class="content-block group border-l border-l-base-red px-2">
        <a
            href="#"
            open
            class="content-block cursor-pointer hover:text-base-red font-semibold text-xl flex gap-3 justify-between items-center"
            onclick="this.closest('div').toggleAttribute('open'); return false;"
        >
            {{ $item->getName() }}
            <i class="fas fa-chevron-up group-open:rotate-180 transition-all duration-300"></i>
        </a>
        <div class="content-text hidden group-open:block">
            <div class="scale-y-0 group-open:scale-y-100 transition-all duration-500 flex flex-col gap-4 pt-4 px-3 text">
                {!! $item->content !!}
            </div>
        </div>
    </div>
@endif
