<div class="flex gap-4">
    <div class="flex-1">
        <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
            Срок обучения
        </h3>
        <p class="text-xl">
            {{(int)$profile->duration}} лет
        </p>
    </div>

    <div class="flex-1">
        <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
            Стоимость обучения за год
        </h3>
        <p class="text-xl">
            {{ number_format($profile->price, 0, '.', ' ') }} &#8381;
        </p>
    </div>
</div>
