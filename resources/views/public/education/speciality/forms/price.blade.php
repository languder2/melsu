<div class="flex-1">
    <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
        Стоимость обучения за год
    </h3>
    <p class="text-xl">
        @if(!$profile->price)
            Данные обновляются
        @else
            {{ number_format($profile->price, 0, '.', ' ') }} &#8381;
        @endif

    </p>
</div>
