@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
{{--    @include('divisions.cabinet.menu')--}}
@endsection

@section('content')
    <div class="grid grid-cols-[auto_auto_1fr_repeat(11,auto)] gap-2">
        <div class="grid grid-cols-subgrid col-span-full sticky top-0 z-10 text-white">
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
            </div>

            <div class="p-3 bg-sky-800 rounded-sm shadow">
                ID
            </div>

            <div class="p-3 bg-sky-800 rounded-sm shadow">
                Подразделение
            </div>

            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Фон
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Описание
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                История
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Галерея
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Направления подготовки
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Цели
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Карьеры
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Партнеров
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Ссылки партнеров
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Логотипы партнеров
            </div>
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Наука
            </div>
        </div>

        @forelse($list as $item)
            <div class="col-span-full grid grid-cols-subgrid">
                <div class="flex gap-3 items-center justify-center flex-wrap w-16 2xl:w-auto bg-white p-3 rounded-sm shadow ">
                    <a href="{{ $item->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
                        <x-lucide-square-arrow-out-up-right class="w-6"/>
                    </a>

                    <a href="{{ $item->cabinet_form }}" class="hover:text-amber-500" title="Редактировать">
                        <x-lucide-square-pen class="w-6" />
                    </a>
                </div>

                <div class="p-3 bg-white shadow text-center rounded-sm flex items-center justify-center">
                    {{ $item->id }}
                </div>

                <div class="p-3 bg-white shadow rounded-sm">
                    {!! $item->nameWithLevel !!}
                </div>

                <div class="p-3 text-center rounded-sm shadow @unless($item->hasBG) bg-red-700 text-white @else bg-white @endunless flex items-center justify-center">
                    {!! $item->hasBG ? "✓" : "x" !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->hasAbout == 0 => 'bg-red-700 text-white',
                        $item->hasAbout > 0 && $item->hasAbout <= 500 => 'bg-amber-400',
                        default => 'bg-white',
                    }

                ])>
                    {!! $item->hasAbout !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->hasHistory == 0 => 'bg-red-700 text-white',
                        $item->hasHistory > 0 && $item->hasHistory <= 500 => 'bg-amber-400',
                        default => 'bg-white',
                    }

                ])>
                    {!! $item->hasHistory !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->hasGallery === 0 => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->hasGallery ? "✓" : "x" !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->hasSpecialities === 0 => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->hasSpecialities !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->countGoals === 0 => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->countGoals !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->countCareers === 0 => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->countCareers !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->countPartners === 0 => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->countPartners !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->countPartners != $item->countPartnersLinks => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->countPartnersLinks !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->countPartners != $item->countPartnersLogo => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->countPartnersLogo !!}
                </div>
                <div @class([
                    "p-3 text-center rounded-sm shadow flex items-center justify-center",
                    match(true){
                        $item->countScience === 0 => 'bg-red-700 text-white',
                        default => 'bg-white',
                    }
                ])>
                    {!! $item->countScience !!}
                </div>

            </div>
        @empty
            <div class="col-span-full text-center font-semibold p-3 text-red-800">
                Нет доступных Вам подразделений.
            </div>
        @endforelse
    </div>

@endsection
