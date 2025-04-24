<section class="container custom lg:p-2.5">
    <div class="page-header pt-6">

        {{Breadcrumbs::view("vendor.breadcrumbs.last-hidden",'speciality',$speciality)}}

        <h1 class="text-xl sm:text-4xl font-bold">
            {{$speciality->spec_code}}
            -
            {{$speciality->name}}
        </h1>
        <p class="text-lg mt-3 mb-6">
            {{$speciality->faculty->name}}
        </p>

        <a href="https://epk.mgu-mlt.ru/login" class="border-2 py-[5px] px-[10px] border-[var(--primary-color)] text-[var(--primary-color)] text-lg uppercase transition duration-300 ease-linear
                                    hover:text-white hover:bg-[var(--primary-color)]">Подать документы</a>

    </div>
</section>


<section class="container custom p-3 pb-0">
    <div class="grid grid-cols-1 lg:grid-cols-[auto_auto_1fr_auto] bg-white p-6 gap-5">
        <div>
            <h4 class="text-neutral-600 uppercase font-bold mb-2">
                Уровень обучения
            </h4>
            <div class="font-bold text-lg">
                {{$speciality->level->getName()}}
            </div>
        </div>
        <div>
            <h2 class="text-neutral-600 uppercase font-bold mb-2 text-right">
                Форма обучения
            </h2>
            @foreach($speciality->profiles as $profile)
                <div class="font-bold text-right">
                    {{$profile->form->getName()}}
                </div>
            @endforeach
        </div>
        <div>
            <h2 class="text-neutral-600 uppercase font-bold mb-2">
                Наименование направления и код
            </h2>
            <div class="font-bold">
                {!! $speciality->spec_code !!} - {!! $speciality->name !!}
            </div>
        </div>
        <div>
            <h2 class="text-neutral-600 uppercase font-bold mb-2 text-right">
                Бюджетных мест
            </h2>
            <div class="font-bold text-right">
                {{$speciality->places}}
            </div>
        </div>
    </div>
</section>

<section class="container custom p-3 pt-0">
    <div
        class="grid grid-cols-1 sm:grid-cols-[1fr_1fr] lg:grid-cols-[1fr_1fr_1fr_1fr_1fr] bg-[var(--primary-color)] p-6 gap-3 sm:text-center lg:text-start lg:gap-0 lg:justify-normal">
        <div>
            <a href="#" class="text-white font-bold text-xl hover:opacity-80 transition duration-300 ease-linear">О
                программе</a>
        </div>
        <div>
            <a href="#" class="text-white font-bold text-xl hover:opacity-80 transition duration-300 ease-linear">Общее</a>
        </div>
        <div>
            <a href="#" class="text-white font-bold text-xl hover:opacity-80 transition duration-300 ease-linear">Документы</a>
        </div>
        <div>
            <a href="#" class="text-white font-bold text-xl hover:opacity-80 transition duration-300 ease-linear">Вопросы</a>
        </div>
        <div>
            <a href="#" class="text-white font-bold text-xl hover:opacity-80 transition duration-300 ease-linear">Карьера</a>
        </div>
    </div>
</section>



<section class="container custom p-3">
    <h2 class="font-bold text-3xl my-6">О программе</h2>
    <div class="bg-white p-6">
        <div class="prog-info text-xl line-clamp-4">
            @foreach($speciality->sections as $section)
                {!! $section->content !!}

            @endforeach
        </div>

        <div class="text-right mt-3">
            <a class="more-prog-btn text-md sm:text-lg border-b-2 border-[#474747] hover:opacity-80 transition duration-300 ease-linear uppercase pb-2 col-span-2 order-3 w-fit mt-3 cursor-pointer">
                Подробнее о программе
            </a>
        </div>
    </div>
</section>

<section class="container custom lg:p-3">
    <h2 class="font-bold text-3xl my-6">Общая информация о программе</h2>
    <div class="flex">
        @foreach($speciality->profiles as $profile)
            <div class="btn-info-prog bg-white group p-6 cursor-pointer active flex-1">
                <h2 class="text-2xl font-bold group-hover:text-base-red group-open:text-base-red transition duration-300 ease-linear">
                    {!! $profile->form->getFullName() !!}
                </h2>
            </div>

        @endforeach
    </div>

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

<div class="box-heading container custom lg:p-2.5">
    <h2 class="font-bold text-3xl my-6">Документы</h2>
</div>
<section class="container custom lg:p-2.5">
    <div class="bg-white p-6 mb-5">
        <ul class="doc-list list-none list-inside marker:text-[var(--secondary-color)] text-[var(--main-color)]">
            <li class="leading-[1.8rem] pb-3">
                <a href="#" class="flex items-center"><i
                        class="bi bi-file-earmark-pdf-fill text-[var(--secondary-color)] text-[30px] me-3"></i>Учебный
                    план</a>
            </li>
            <li class="leading-[1.8rem] pb-3">
                <a href="#" class="flex items-center"><i
                        class="bi bi-file-earmark-pdf-fill text-[var(--secondary-color)] text-[30px] me-3"></i>Карта
                    дисциплин</a>
            </li>
        </ul>
    </div>
</section>

<div class="box-heading container custom lg:p-2.5">
    <h2 class="font-bold text-3xl my-6">Вопросы о программе </h2>
</div>
<section class="container custom lg:p-2.5">
    <div class="bg-white mb-5">
        <div class='accordion-group grid grid-cols-1 gap-1' data-accordion="default-accordion">
            <div class='accordion-box accordion p-6' style="min-height: 73px;">
                <button
                    class='accordion-toggle group accordion-active:text-indigo-600 inline-flex items-center justify-between text-[var(--primary-color)] w-full transition duration-500 hover:text-[var(--secondary-color)] active:text-[var(--secondary-color)]'
                    aria-controls='basic-collapse-one-default'>
                    <h5 class="font-[600] text-lg">Кем я смогу работать после первого курса?</h5>
                    <svg
                        class='text-[var(--primary-color)] transition duration-500 group-hover:text-[var(--secondary-color)]'
                        width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path
                            d='M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25'
                            stroke='currentColor' stroke-width='1.6' stroke-linecap='round'
                            stroke-linejoin='round'></path>
                    </svg>
                </button>
                <div class='accordion-content-box accordion-content px-0 overflow-hidden max-w-[930px] w-[100%]'
                     aria-labelledby='basic-heading-one-default'>
                    <div class="accordion-text text-md py-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti dolorem excepturi
                        officiis quasi quia repudiandae velit veniam vero vitae!
                        Corporis eligendi, obcaecati officiis quas quo reiciendis veritatis. Commodi, dolores.
                    </div>
                </div>
            </div>
            <div class='accordion-box accordion p-6' style="min-height: 73px;">
                <button
                    class='accordion-toggle group accordion-active:text-indigo-600 inline-flex items-center justify-between text-[var(--primary-color)] w-full transition duration-500 hover:text-[var(--secondary-color)] active:text-[var(--secondary-color)]'
                    aria-controls='basic-collapse-one-default'>
                    <h5 class="font-[600] text-lg">Почему на данном профиле нет дисциплины Физика?</h5>
                    <svg
                        class='text-[var(--primary-color)] transition duration-500 group-hover:text-[var(--secondary-color)]'
                        width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path
                            d='M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25'
                            stroke='currentColor' stroke-width='1.6' stroke-linecap='round'
                            stroke-linejoin='round'></path>
                    </svg>
                </button>
                <div class='accordion-content-box accordion-content px-0 overflow-hidden max-w-[930px] w-[100%]'
                     aria-labelledby='basic-heading-one-default'>
                    <div class="accordion-text text-md py-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti dolorem excepturi
                        officiis quasi quia repudiandae velit veniam vero vitae!
                        Corporis eligendi, obcaecati officiis quas quo reiciendis veritatis. Commodi, dolores.
                    </div>
                </div>
            </div>
            <div class='accordion-box accordion p-6' style="min-height: 73px;">
                <button
                    class='accordion-toggle group accordion-active:text-indigo-600 inline-flex items-center justify-between text-[var(--primary-color)] w-full transition duration-500 hover:text-[var(--secondary-color)] active:text-[var(--secondary-color)]'
                    aria-controls='basic-collapse-one-default'>
                    <h5 class="font-[600] text-lg">У меня есть идея-мечта о создании собственного продукта, поможет ли
                        мне данная программа?</h5>
                    <svg
                        class='text-[var(--primary-color)] transition duration-500 group-hover:text-[var(--secondary-color)]'
                        width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path
                            d='M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25'
                            stroke='currentColor' stroke-width='1.6' stroke-linecap='round'
                            stroke-linejoin='round'></path>
                    </svg>
                </button>
                <div class='accordion-content-box accordion-content px-0 overflow-hidden max-w-[930px] w-[100%]'
                     aria-labelledby='basic-heading-one-default'>
                    <div class="accordion-text text-md py-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti dolorem excepturi
                        officiis quasi quia repudiandae velit veniam vero vitae!
                        Corporis eligendi, obcaecati officiis quas quo reiciendis veritatis. Commodi, dolores.
                    </div>
                </div>
            </div>
            <div class='accordion-box accordion p-6' style="min-height: 73px;">
                <button
                    class='accordion-toggle group accordion-active:text-indigo-600 inline-flex items-center justify-between text-[var(--primary-color)] w-full transition duration-500 hover:text-[var(--secondary-color)] active:text-[var(--secondary-color)]'
                    aria-controls='basic-collapse-one-default'>
                    <h5 class="font-[600] text-lg">Я вижу, что дисциплины по программированию есть и в других вузах, чем
                        у вас лучше?</h5>
                    <svg
                        class='text-[var(--primary-color)] transition duration-500 group-hover:text-[var(--secondary-color)]'
                        width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path
                            d='M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25'
                            stroke='currentColor' stroke-width='1.6' stroke-linecap='round'
                            stroke-linejoin='round'></path>
                    </svg>
                </button>
                <div class='accordion-content-box accordion-content px-0 overflow-hidden max-w-[930px] w-[100%]'
                     aria-labelledby='basic-heading-one-default'>
                    <div class="accordion-text text-md py-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti dolorem excepturi
                        officiis quasi quia repudiandae velit veniam vero vitae!
                        Corporis eligendi, obcaecati officiis quas quo reiciendis veritatis. Commodi, dolores.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="#"
           class="text-lg border-b-2 border-[#474747] hover:opacity-80 transition duration-300 ease-linear uppercase pb-2">Все
            вопросы и ответы</a>
    </div>
</section>

<div class="box-heading container custom lg:p-2.5">
    <h2 class="font-bold text-3xl my-6">Карьера после обучения</h2>
</div>
<section class="container custom lg:p-2.5">
    <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr]">
        <div class="bg-[var(--primary-color)] p-6 text-white">
            <div class="flex flex-col lg:flex-row justify-between mb-3">
                <div>
                    <h2 class="text-white font-bold text-xl">Middle frontend-разработчик</h2>
                </div>
                <div>
                    <h2 class="text-lg font-bold">от <span class="text-2xl">80</span> тыс.</h2>
                    <h2 class="text-lg font-[500]">Зарплата, ₽</h2>
                </div>
            </div>
            <div class="mb-3">
                <p class="text-lg line-clamp-6">
                    Разрабатывает продукты компании на языке javascript, поддерживает и развивает текущую архитектуру
                    приложений,
                    разрабатывает кросс-браузерную адаптивную вёрстку веб-компонентов, участвует в планировании и оценке
                    задач, участвует в проектировании интерфейсов.
                </p>
            </div>
            <div>
                <button data-modal-target="default-modal-1" data-modal-toggle="default-modal-1"
                        class="block text-white text-lg font-bold border-b-2 border-white hover:opacity-80 transition duration-300 ease-linear"
                        type="button">
                    Читать полностью
                </button>
            </div>
            <div id="default-modal-1" tabindex="-1" aria-hidden="true"
                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full dark:bg-white dark:bg-opacity-50">
                <div class="relative p-2.5 w-full max-w-7xl max-h-full opacity-100">
                    <div class="relative bg-white text-[#4C4C4C]">
                        <div class="flex items-center justify-between p-4 md:p-6 border-b">
                            <h3 class="text-xl font-semibold">
                                Middle frontend-разработчик
                            </h3>
                            <button type="button"
                                    class="bg-transparent hover:bg-[var(--primary-color)] hover:text-white text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition duration-300 ease-linear"
                                    data-modal-hide="default-modal-1">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-6 space-y-4">
                            <p class="text-base leading-relaxed">
                                Разрабатывает продукты компании на языке javascript, поддерживает и развивает текущую
                                архитектуру приложений,
                                разрабатывает кросс-браузерную адаптивную вёрстку веб-компонентов, участвует в
                                планировании и оценке задач, участвует в проектировании интерфейсов.
                            </p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center px-4 py-2 md:p-6 border-t">
                            <button data-modal-hide="default-modal-1" type="button"
                                    class=" border-b-2 border-[#4C4C4C] hover:opacity-80 transition duration-300 ease-linear">
                                Закрыть
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 text-[#4C4C4C]">
            <div class="flex flex-col lg:flex-row justify-between mb-3">
                <div>
                    <h2 class="font-bold text-xl">Middle frontend-разработчик</h2>
                </div>
                <div>
                    <h2 class="text-lg font-bold">от <span class="text-2xl">80</span> тыс.</h2>
                    <h2 class="text-lg font-[500]">Зарплата, ₽</h2>
                </div>
            </div>
            <div class="mb-3">
                <p class="text-lg line-clamp-6">
                    Разрабатывает продукты компании на языке javascript, поддерживает и развивает текущую архитектуру
                    приложений,
                    разрабатывает кросс-браузерную адаптивную вёрстку веб-компонентов, участвует в планировании и оценке
                    задач, участвует в проектировании интерфейсов.
                </p>
            </div>
            <div>
                <button data-modal-target="default-modal-2" data-modal-toggle="default-modal-2"
                        class="block text-lg font-bold border-b-2 border-[#4C4C4C] hover:opacity-80 transition duration-300 ease-linear"
                        type="button">
                    Читать полностью
                </button>
            </div>
            <div id="default-modal-2" tabindex="-1" aria-hidden="true"
                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full dark:bg-white dark:bg-opacity-50">
                <div class="relative p-2.5 w-full max-w-7xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white text-[#4C4C4C]">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-6 border-b">
                            <h3 class="text-xl font-semibold">
                                Middle frontend-разработчик
                            </h3>
                            <button type="button"
                                    class="bg-transparent hover:bg-[var(--primary-color)] hover:text-white text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition duration-300 ease-linear"
                                    data-modal-hide="default-modal-2">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-6 space-y-4">
                            <p class="text-base leading-relaxed">
                                Разрабатывает продукты компании на языке javascript, поддерживает и развивает текущую
                                архитектуру приложений,
                                разрабатывает кросс-браузерную адаптивную вёрстку веб-компонентов, участвует в
                                планировании и оценке задач, участвует в проектировании интерфейсов.
                            </p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center px-4 py-2 md:p-6 border-t">
                            <button data-modal-hide="default-modal-2" type="button"
                                    class=" border-b-2 border-[#4C4C4C] hover:opacity-80 transition duration-300 ease-linear">
                                Закрыть
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="box-heading container custom">
    <h2 class="font-bold text-3xl my-6">Сделайте следующий шаг</h2>
</div>
<section class="container custom lg:p-2.5">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr_2fr]">
        <div class="jst-block bg-[#252422] p-6 text-white hover:opacity-[0.9]">
            <a href="#" class="min-h-[160px] lg:min-h-[295px] flex flex-col justify-between">
                <h2 class="font-bold text-lg">Узнать, как поступить</h2>
                <div class="text-end">
                                <span class="text-xl font-[400]">
                                    Подробнее
                                    <i class="bi bi-arrow-right align-text-top"></i>
                                </span>
                </div>
            </a>
        </div>
        <div class="jst-block bg-[var(--secondary-color)] p-6 text-white hover:opacity-[0.9]">
            <a href="#" class="min-h-[160px] lg:min-h-[295px] flex flex-col justify-between">
                <h2 class="font-bold text-lg">Подберите мне программу</h2>
                <div class="text-end">
                              <span class="text-xl font-[400]">
                                    Подробнее
                                    <i class="bi bi-arrow-right align-text-top"></i>
                                </span>
                </div>
            </a>
        </div>
        <div class="jst-block bg-[#383838] p-6 text-white hover:opacity-[0.9]">
            <a href="#" class="min-h-[160px] lg:min-h-[295px] flex flex-col justify-between">
                <h2 class="font-bold text-lg">Выбрать программу</h2>
                <div class="text-end">
                               <span class="text-xl font-[400]">
                                    Подробнее
                                    <i class="bi bi-arrow-right align-text-top"></i>
                                </span>
                </div>
            </a>
        </div>
    </div>
</section>

<div class="box-heading container custom">
    <h2 class="font-bold text-3xl my-6">Другие программы</h2>
</div>
<section class="container custom lg:p-2.5">
    <div class="parent grid grid-cols-1 lg:grid-cols-[1fr_1fr] xl:grid-cols-[1fr_1fr_1fr] gap-3">
        <div class="box-searching card-nap position-aware">
            <a href="#" class="p-4 w-full">
                <div>
                    <p class="sku uppercase font-[500] mb-3">
                        Технический факультет
                    </p>
                    <h2 class="text-xl font-[600] name mb-6 line-clamp-2">Информационные технологии в креативных
                        индустриях (Информационные системы и технологии)</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                    <div class="flex flex-col">
                        <span class="font-[400]">400 тыс</span>
                        <span class="font-[400] text-sm text-[#96918E]">Стоимость, ₽</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400]">258</span>
                        <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400] text-sm">55</span>
                        <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400] text-sm">5</span>
                        <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>
                    </div>
                </div>
                <span class="aware-bg"></span>
            </a>
        </div>
        <div class="box-searching card-nap position-aware">
            <a href="#" class="p-4 w-full">
                <div>
                    <p class="sku uppercase font-[500] mb-3">
                        Агротехнологический факультет
                    </p>
                    <h2 class="text-xl font-[600] name mb-6 line-clamp-2">38.02.01 Экономика и бухгалтерский учет (по
                        отраслям)</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                    <div class="flex flex-col">
                        <span class="font-[400]">400 тыс</span>
                        <span class="font-[400] text-sm text-[#96918E]">Стоимость, ₽</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400]">258</span>
                        <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400] text-sm">55</span>
                        <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400] text-sm">5</span>
                        <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>
                    </div>
                </div>
                <span class="aware-bg"></span>
            </a>
        </div>
        <div
            class="box-searching card-nap position-aware lg:col-span-2 xl:col-span-1 lg:min-h-[240px] xl:min-h-[300px]">
            <a href="#" class="p-4 w-full">
                <div>
                    <p class="sku uppercase font-[500] mb-3">
                        Факультет туризма и сервиса
                    </p>
                    <h2 class="text-xl font-[600] name mb-6 line-clamp-2">43.02.16 Туризм и гостеприимство</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                    <div class="flex flex-col">
                        <span class="font-[400]">400 тыс</span>
                        <span class="font-[400] text-sm text-[#96918E]">Стоимость, ₽</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400]">258</span>
                        <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400] text-sm">55</span>
                        <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-[400] text-sm">5</span>
                        <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>
                    </div>
                </div>
                <span class="aware-bg"></span>
            </a>
        </div>
    </div>
</section>
