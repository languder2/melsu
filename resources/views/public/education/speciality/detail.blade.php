<section>
    <h2 class="font-bold text-3xl my-6">Общая информация о программе</h2>
    <div class="flex flex-col lg:flex-row">
        @foreach($speciality->profiles as $profile)
            <label
                for="profile_{{$profile->form}}"
                class="
                    group
                    bg-white p-6 cursor-pointer flex-1 text-2xl font-bold transition duration-200
                    border-2 border-white
                    has-checked:bg-base-red
                "
            >
                <input
                    id="profile_{{$profile->form}}"
                    type="radio"
                    name="form"
                    @checked($loop->first)

                    value="panel_{{$profile->form}}"
{{--                    class="hidden"--}}
                >
                    {!! $profile->form->getFullName() !!}
            </label>

        @endforeach
    </div>
</section>


<section class="container custom lg:p-3">

    <div class="box-info-prog grid grid-cols-1 sm:grid-cols-[1fr_1fr] sm:gap-1">
        <div class="btn-info-prog bg-white group p-6 cursor-pointer active">
            <h2 class="text-2xl font-bold group-hover:text-[var(--primary-color)] transition duration-300 ease-linear">
                Очная форма</h2>
        </div>
        <div class="btn-info-prog bg-white group p-6 cursor-pointer">
            <h2 class="text-2xl font-bold group-hover:text-[var(--primary-color)] transition duration-300 ease-linear">
                Заочная форма</h2>
        </div>
    </div>

    <div class="relative">
        <div class="content-info-prog bg-white p-6 active">
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] gap-3">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">Срок обучения</h2>
                    <h2 class="font-[400] text-xl">5 лет</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">Стоимость обучения за год</h2>
                    <h2 class="font-[400] text-xl">141 800 руб</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Вступительные испытания и минимальные баллы
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] gap-3">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на бюджет</h2>
                    <h2 class="font-[400] text-xl">Информатика и ИКТ/Физика — 52/44 баллов</h2>
                    <h2 class="font-[400] text-xl">Математика (профильная) — 47 баллов</h2>
                    <h2 class="font-[400] text-xl">Русский язык — 45 баллов</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на платное</h2>
                    <h2 class="font-[400] text-xl">Информатика и ИКТ/Физика — 46/41 баллов</h2>
                    <h2 class="font-[400] text-xl">Математика (профильная) — 41 балл</h2>
                    <h2 class="font-[400] text-xl">Русский язык — 42 балла</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Проходные баллы в прошлом году
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] md:gap-3">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на бюджет</h2>
                    <h2 class="font-[400] text-xl">Проходной балл — 258 (2023)</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на платное</h2>
                    <h2 class="font-[400] text-xl">Проходной балл — 258 (2023)</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Основаня информация
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] lg:grid-cols-[1fr_1fr_1fr]">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">основной корпус</h2>
                    <h2 class="font-[400] text-xl">Мелитополь, Проспект Б. Хмельницкого, 18</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">руководитель</h2>
                    <h2 class="font-[400] text-xl">Иванов Иван Иванович</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">прием иностранных граждан</h2>
                    <h2 class="font-[400] text-xl">Возможен</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Дополнительная информация и полезные ссылки
            </h2>
            <div class="grid grid-cols-[1fr] md:grid-cols-[1fr_1fr] xl:grid-cols-[25%_15%_30%_30%] gap-y-3">
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Подготовительные курсы</a>
                </div>
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Олимпиады</a>
                </div>
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Проходные баллы прошлых лет</a>
                </div>
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Вступительные после колледжа</a>
                </div>
            </div>
        </div>
        <div class="content-info-prog bg-white p-6 hidden">
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] gap-3">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">Срок обучения</h2>
                    <h2 class="font-[400] text-xl">5 лет</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">Стоимость обучения за год</h2>
                    <h2 class="font-[400] text-xl">200 800 руб</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Вступительные испытания и минимальные баллы
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] gap-3">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на бюджет</h2>
                    <h2 class="font-[400] text-xl">Информатика и ИКТ/Физика — 52/44 баллов</h2>
                    <h2 class="font-[400] text-xl">Математика (профильная) — 47 баллов</h2>
                    <h2 class="font-[400] text-xl">Русский язык — 45 баллов</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на платное</h2>
                    <h2 class="font-[400] text-xl">Информатика и ИКТ/Физика — 46/41 баллов</h2>
                    <h2 class="font-[400] text-xl">Математика (профильная) — 41 балл</h2>
                    <h2 class="font-[400] text-xl">Русский язык — 42 балла</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Проходные баллы в прошлом году
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] md:gap-3">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на бюджет</h2>
                    <h2 class="font-[400] text-xl">Проходной балл — 258 (2023)</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">на платное</h2>
                    <h2 class="font-[400] text-xl">Проходной балл — 258 (2023)</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Основаня информация
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] lg:grid-cols-[1fr_1fr_1fr]">
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">основной корпус</h2>
                    <h2 class="font-[400] text-xl">Мелитополь, Проспект Б. Хмельницкого, 18</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">руководитель</h2>
                    <h2 class="font-[400] text-xl">Иванов Иван Иванович</h2>
                </div>
                <div class="mb-3 lg:mb-0">
                    <h2 class="text-[#828282] uppercase font-bold text-lg mb-2">прием иностранных граждан</h2>
                    <h2 class="font-[400] text-xl">Возможен</h2>
                </div>
            </div>
            <h2 class="uppercase font-bold text-lg my-4 sm:my-8">
                Дополнительная информация и полезные ссылки
            </h2>
            <div class="grid grid-cols-[1fr] md:grid-cols-[1fr_1fr] xl:grid-cols-[25%_15%_30%_30%] gap-y-3">
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Подготовительные курсы</a>
                </div>
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Олимпиады</a>
                </div>
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Проходные баллы прошлых лет</a>
                </div>
                <div class="mb-3 lg:mb-0">
                    <a class="font-[400] text-xl text-[var(--primary-color)]">Вступительные после колледжа</a>
                </div>
            </div>
        </div>
    </div>
</section>

