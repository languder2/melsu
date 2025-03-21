@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ": Направления подготовки')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'speciality',$speciality)}}
@endsection

@section('aside')
    @component('public.menu.aside-tree',compact('menu')) @endcomponent
@endsection



@section('content')
    <div class="flex flex-col gap-4">

    <div class="text-right mb-2">
        <a
            href="#"
            class="
                border-2 py-2 px-3 border-base-red
                text-base-red text-lg uppercase
                transition duration-300 ease-linear
                hover:text-white hover:bg-base-red
            "
        >
            Подать документы
        </a>

    </div>
    <h2 class="text-xl sm:text-4xl font-bold">
        {{$speciality->spec_code}}
        -
        {{$speciality->name}}
    </h2>

    <section>
        <div class="grid grid-cols-1 xl:grid-cols-[auto_auto_1fr_auto] bg-white p-6 gap-5">
            <div>
                <h4 class="text-neutral-600 uppercase font-bold mb-2">
                    Уровень обучения
                </h4>
                <div class="font-bold text-lg">
                    {{$speciality->level->getName()}}
                </div>
            </div>
            <div>
                <h2 class="text-neutral-600 uppercase font-bold mb-2 xl:text-right">
                    Форма обучения
                </h2>
                @foreach($speciality->profiles as $profile)
                    <div class="font-bold xl:text-right">
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
                <h2 class="text-neutral-600 uppercase font-bold mb-2 xl:text-right">
                    Бюджетных мест
                </h2>
                <div class="font-bold xl:text-right">
                    {{$speciality->places}}
                </div>
            </div>
        </div>
        @include('public.education.speciality.menu')
    </section>

    @include('public.education.speciality.about')

    @include('public.education.speciality.detail')




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
</div>
@endsection


