<section class="card-section">
    <div
        class="grid grid-cols-1 lg:grid-cols-[65%_25%] xl:grid-cols-[45%_20%] gap-[12px] lg:gap-[10%] xl:gap-[35%] mb-3 lg:mb-0">
        <div class="box-btns-card grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr] gap-3 text-center lg:mb-8">
            <a class="btn-filter-card active uppercase py-[15px] px-[20px]">Все</a>
            <a class="btn-filter-card uppercase py-[15px] px-[20px]">Колледжи</a>
            <a class="btn-filter-card uppercase py-[15px] px-[20px]">Бакалавриат</a>
            <a class="btn-filter-card uppercase py-[15px] px-[20px]">Специалитет</a>
            <a class="btn-filter-card uppercase py-[15px] px-[20px]">Магистратура</a>
            <a class="btn-filter-card uppercase py-[15px] px-[20px]">Аспирантура</a>
        </div>
        <div class="flex flex-col max-h-[112px]">
            <select class="dropdown-list mb-[12px]" name="form-edu">
                <option>Форма обучения</option>
            </select>
            <select class="dropdown-list" name="faculty">
                <option>Естественных наук</option>
            </select>
        </div>
    </div>
</section>
<div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] xl:grid-cols-[1fr_1fr_1fr] gap-3">
    @foreach($list as $spec)
        <div class="card-naprav p-3 text-baseRed hover:text-white">
            <a href="#">
                <h2 class="text-xl font-semibold">
                    {{$spec->spec_code}}
                    -
                    {{$spec->name}}
                </h2>
                <div class="flex flex-col">
                    <span>400 тыс</span>
                    <span>Стоимость в год</span>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                    <div class="flex flex-col text-sm">
                        <span>55</span>
                        <span>Бюджетных мест</span>
                    </div>
                    <div class="flex flex-col text-sm">
                        <span>5</span>
                        <span>Срок обучения</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    <div class="card-naprav p-2.5 text-white">
        <a href="#">
            <h2 class="text-xl font-[600]">44.03.05 – Педагогическое образование (с двумя профилями подготовки)
                (География. Физическая культура)</h2>
            <div class="flex flex-col">
                <span class="font-[400]">400 тыс</span>
                <span class="font-[400]">Стоимость в год</span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">55</span>
                    <span class="font-[400] text-sm">Бюджетных мест</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">5</span>
                    <span class="font-[400] text-sm">Срок обучения</span>
                </div>
            </div>
        </a>
    </div>
    <div class="card-naprav p-2.5 text-white">
        <a href="#">
            <h2 class="text-xl font-[600]">44.03.05 – Педагогическое образование (с двумя профилями подготовки)
                (География. Физическая культура)</h2>
            <div class="flex flex-col">
                <span class="font-[400]">400 тыс</span>
                <span class="font-[400]">Стоимость в год</span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">55</span>
                    <span class="font-[400] text-sm">Бюджетных мест</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">5</span>
                    <span class="font-[400] text-sm">Срок обучения</span>
                </div>
            </div>
        </a>
    </div>
    <div class="card-naprav p-2.5 text-white">
        <a href="#">
            <h2 class="text-xl font-[600]">44.03.05 – Педагогическое образование (с двумя профилями подготовки)
                (География. Физическая культура)</h2>
            <div class="flex flex-col">
                <span class="font-[400]">400 тыс</span>
                <span class="font-[400]">Стоимость в год</span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">55</span>
                    <span class="font-[400] text-sm">Бюджетных мест</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">5</span>
                    <span class="font-[400] text-sm">Срок обучения</span>
                </div>
            </div>
        </a>
    </div>
    <div class="card-naprav p-2.5 text-white">
        <a href="#">
            <h2 class="text-xl font-[600]">44.03.05 – Педагогическое образование (с двумя профилями подготовки)
                (География. Физическая культура)</h2>
            <div class="flex flex-col">
                <span class="font-[400]">400 тыс</span>
                <span class="font-[400]">Стоимость в год</span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">55</span>
                    <span class="font-[400] text-sm">Бюджетных мест</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">5</span>
                    <span class="font-[400] text-sm">Срок обучения</span>
                </div>
            </div>
        </a>
    </div>
    <div class="card-naprav p-2.5 text-white">
        <a href="#">
            <h2 class="text-xl font-[600]">44.03.05 – Педагогическое образование (с двумя профилями подготовки)
                (География. Физическая культура)</h2>
            <div class="flex flex-col">
                <span class="font-[400]">400 тыс</span>
                <span class="font-[400]">Стоимость в год</span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">55</span>
                    <span class="font-[400] text-sm">Бюджетных мест</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-[400] text-sm">5</span>
                    <span class="font-[400] text-sm">Срок обучения</span>
                </div>
            </div>
        </a>
    </div>
</div>

@dump($list)
