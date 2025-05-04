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

        <h2 class="text-xl sm:text-4xl font-bold">
            {{$speciality->spec_code}}
            -
            {{$speciality->name}}
        </h2>
        <div class="mb-2">
            <a
                href="https://epk.mgu-mlt.ru/login"
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
                    @foreach($speciality->publicProfiles as $profile)
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

        @if($speciality->publicProfiles->count())
            <section>
                @include('public.education.speciality.forms.tabs')
                @include('public.education.speciality.forms.panels')
            </section>
        @endif


        @component('documents.public.includes.block',['list'=> $speciality->publicDocuments])
            Документы
        @endcomponent

        @component('public.faq.section',['list'=>$speciality->faq(true)->get()])
            Вопросы о программе
        @endcomponent

        @component('public.career.section',['list'=>$speciality->career])
            Карьера после обучения
        @endcomponent

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

{{--        <div class="box-heading container custom hidden">--}}
{{--            <h2 class="font-bold text-3xl my-6">Другие программы</h2>--}}
{{--        </div>--}}
{{--        <section class="container custom lg:p-2.5 hidden">--}}
{{--            <div class="parent grid grid-cols-1 lg:grid-cols-[1fr_1fr] xl:grid-cols-[1fr_1fr_1fr] gap-3">--}}
{{--                <div class="box-searching card-nap position-aware">--}}
{{--                    <a href="#" class="p-4 w-full">--}}
{{--                        <div>--}}
{{--                            <p class="sku uppercase font-[500] mb-3">--}}
{{--                                Технический факультет--}}
{{--                            </p>--}}
{{--                            <h2 class="text-xl font-[600] name mb-6 line-clamp-2">Информационные технологии в креативных--}}
{{--                                индустриях (Информационные системы и технологии)</h2>--}}
{{--                        </div>--}}
{{--                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400]">400 тыс</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Стоимость, ₽</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400]">258</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400] text-sm">55</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400] text-sm">5</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <span class="aware-bg"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="box-searching card-nap position-aware">--}}
{{--                    <a href="#" class="p-4 w-full">--}}
{{--                        <div>--}}
{{--                            <p class="sku uppercase font-[500] mb-3">--}}
{{--                                Агротехнологический факультет--}}
{{--                            </p>--}}
{{--                            <h2 class="text-xl font-[600] name mb-6 line-clamp-2">38.02.01 Экономика и бухгалтерский учет (по--}}
{{--                                отраслям)</h2>--}}
{{--                        </div>--}}
{{--                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400]">400 тыс</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Стоимость, ₽</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400]">258</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400] text-sm">55</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400] text-sm">5</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <span class="aware-bg"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div--}}
{{--                    class="box-searching card-nap position-aware lg:col-span-2 xl:col-span-1 lg:min-h-[240px] xl:min-h-[300px]">--}}
{{--                    <a href="#" class="p-4 w-full">--}}
{{--                        <div>--}}
{{--                            <p class="sku uppercase font-[500] mb-3">--}}
{{--                                Факультет туризма и сервиса--}}
{{--                            </p>--}}
{{--                            <h2 class="text-xl font-[600] name mb-6 line-clamp-2">43.02.16 Туризм и гостеприимство</h2>--}}
{{--                        </div>--}}
{{--                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400]">400 тыс</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Стоимость, ₽</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400]">258</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400] text-sm">55</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex flex-col">--}}
{{--                                <span class="font-[400] text-sm">5</span>--}}
{{--                                <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <span class="aware-bg"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    </div>
@endsection


