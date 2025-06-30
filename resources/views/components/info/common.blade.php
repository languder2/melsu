@isset($itemprop)
    <div class="bg-white px-4 py-2 hidden lg:flex items-center">
        {!! $label ?? '-' !!}
    </div>
    <div class="bg-white py-2 flex flex-col gap-2 justify-center text-center lg:text-left">
        <p class="px-4 pb-2 lg:hidden font-semibold border-b">
            {!! $label ?? '-' !!}
        </p>
        <p class="px-4" itemprop="{{ $itemprop }}">
            {!! $content ?? 'отсутствует' !!}
        </p>
    </div>
@endisset
