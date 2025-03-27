@extends("layouts.main")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="mx-20 py-10">

        <section class="mx-auto max-w-[1600px] border-dashed border-b border-b-neutral-400">

        <h4  class="text-center font-semibold text-xl">ВСИУПИТЕЛЬНЫЕ ИСПЫТАНИЯ И МИНИМАЛЬНЫЕ БАЛЛЫ</h4>
        <div class="flex gap-10">
            <div class="flex-1 flex flex-col">
                <h5 class="text-center font-semibold text-2xl text-neutral-700">НА БЮДЖЕТЕ</h5>
                <div class="flex-grow">
                    <div class="flex flex-col gap-3">
                        <span class="font-semibold text-neutral-700 text-lg">Обязательные:</span>
                        <div class="flex justify-between">
                            <span>Биология</span>
                            <span class="font-semibold">39</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Литература</span>
                            <span class="font-semibold">40</span>
                        </div>
                        <span class="font-semibold text-neutral-700 text-lg">На выбор:</span>
                        <div class="flex justify-between">
                            <span>Общесвтознание (Литература)</span>
                            <span class="font-semibold">45</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Информатика</span>
                            <span class="font-semibold">23</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between border-t border-neutral-400 py-4 mt-5">
                    <span class="font-semibold">Минимальное кол-во проходных баллов</span>
                    <span class="font-semibold">170</span>
                </div>
            </div>

            <div class="flex-1 flex flex-col hidden">
                <h5 class="text-center font-semibold text-2xl text-neutral-700">НА ПЛАТНОЕ</h5>
                <div class="flex-grow">
                    <div class="flex flex-col gap-3 hidden">
                        <span class="font-semibold text-neutral-700 text-lg">Обязательные:</span>
                        <div class="flex justify-between">
                            <span>Биология</span>
                            <span class="font-semibold">39</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Общесвтознание</span>
                            <span class="font-semibold">45</span>
                        </div>
                        <span class="font-semibold text-neutral-700 text-lg">На выбор:</span>
                        <div class="flex justify-between">
                            <span>Конкурс аттестатов+Творческое испытание</span>
                            <span class="font-semibold">13</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between border-t border-neutral-400 py-4 mt-5">
                    <span class="font-semibold">Минимальное кол-во проходных баллов</span>
                    <span class="font-semibold">330</span>
                </div>
            </div>
        </div>

        {{--<div class="flex gap-10">
            <div class="flex-1 flex justify-between">
                <span>Минимальное кол-во проходных баллов</span>
                <span>270</span>
            </div>

            <div class="flex-1 flex justify-between">
                <span>Минимальное кол-во проходных баллов</span>
                <span>270</span>
            </div>
        </div>--}}
    </section>
    </div>
@endsection
