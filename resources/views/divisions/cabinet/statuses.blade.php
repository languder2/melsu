@extends("layouts.cabinet")

@section('title', 'Состояние заполнения')

@section('content-header')
    {{--    @include('divisions.cabinet.menu')--}}
@endsection

@section('content')
    <div class="grid grid-cols-[auto_auto_1fr_repeat(12,auto)] gap-2">
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
            <div class="p-3 bg-sky-800 rounded-sm shadow text-center">
                Выпускники
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

                <a
                    href="{{ $item->cabinet_form }}"
                    title="{!! $item->hasBG ? "Фон заголовка установлен" : "Фон заголовка не установлен" !!}"
                    class="
                        p-3 text-center rounded-sm shadow
                        @unless($item->hasBG) bg-red-700 text-white @else bg-white @endunless
                        flex items-center justify-center
                        hover:bg-sky-700 hover:text-white cursor-pointer
                    "
                >
                    {!! $item->hasBG ? "✓" : "x" !!}
                </a>
                <a
                    href="{{ $item->cabinet_form }}"
                    title="Количество символов в описании"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->hasAbout == 0 => 'bg-red-700 text-white',
                            $item->hasAbout > 0 && $item->hasAbout <= 500 => 'bg-amber-400',
                            default => 'bg-white',
                        }
                    ])
                >
                        {!! $item->hasAbout !!}
                </a>
                <a
                    href="{{ $item->history_form }}"
                    title="Количество символов в истории"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->hasHistory == 0 => 'bg-red-700 text-white',
                            $item->hasHistory > 0 && $item->hasHistory <= 500 => 'bg-amber-400',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->hasHistory !!}
                </a>
                <a
                    href="{{ $item->gallery_form }}"
                    title="Заполнена ли галерея"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->hasGallery === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->hasGallery ? "✓" : "x" !!}
                </a>
                <span
                    title="Количество направлений подготовки (без учета профилей)"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
//                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->hasSpecialities === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->hasSpecialities !!}
                </span>
                <a
                    href="{{ $item->goals_cabinet_list }}"
                    title="Количество указанных целей и задач"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countGoals === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countGoals !!}
                </a>
                <a
                    href="{{ $item->careers_cabinet_list }}"
                    title="Количество указанных карьер"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countCareers === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countCareers !!}
                </a>
                <a
                    href="{{ $item->partnersCabinetList() }}"
                    title="Количество указанных партнеров"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countPartners === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countPartners !!}
                </a>
                <a
                    href="{{ $item->partnersCabinetList() }}"
                    title="Количество ссылок у указанных партнеров"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countPartners != $item->countPartnersLinks => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countPartnersLinks !!}
                </a>
                <a
                    href="{{ $item->partnersCabinetList() }}"
                    title="Количество установленных логотипов у указанных партнеров"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countPartners != $item->countPartnersLogo => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countPartnersLogo !!}
                </a>
                <a
                    href="{{ $item->science_cabinet_list }}"
                    title="Количество пунктов в разделе наука"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countScience === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countScience !!}
                </a>
                <a
                    href="{{ $item->graduations_cabinet_list }}"
                    title="Количество указанных выпускников"
                    @class([
                        "p-3 text-center rounded-sm shadow flex items-center justify-center",
                        'hover:bg-sky-700 hover:text-white cursor-pointer',
                        match(true){
                            $item->countGraduations === 0 => 'bg-red-700 text-white',
                            default => 'bg-white',
                        }
                    ])
                >
                    {!! $item->countGraduations !!}
                </a>

            </div>
        @empty
            <div class="col-span-full text-center font-semibold p-3 text-red-800">
                Нет доступных Вам подразделений.
            </div>
        @endforelse
    </div>

@endsection
