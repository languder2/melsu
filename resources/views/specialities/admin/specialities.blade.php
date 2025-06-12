@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {!!Breadcrumbs::view("vendor.breadcrumbs.base",'education-programs:higher-education')!!}
@endsection

@section('content')


    <form method="get" class="flex gap-4 mb-4 bg-white mx-4 p-4 items-center pe-40">
        @csrf
            <div class="flex-1" >
            <input
                type="text"
                name="search"
                placeholder="Поиск по коду или названию"
                class="
                    w-full
                    outline-0
                    p-2
                    border-b
                "
                value="{{ $filters['search'] ?? null }}"
            >
        </div>

        <select name="level" class="outline-0 border-b p-2">
            <option value="">Все</option>
            @foreach(\App\Enums\EducationLevel::getListAlt() as $level=>$item)
                <option
                    value="{{ $level }}"
                    @selected(array_key_exists('level',$filters) && $filters['level'] === $level)
                >
                    {{ $item }}
                </option>
            @endforeach
        </select>

        <select name="show" class="outline-0 border-b p-2">
            <option value="">Все</option>
            <option
                value="show"
                @selected(array_key_exists('show',$filters) && $filters['show'] === 'show')
            >
                Показываются
            </option>
            <option
                value="hide"
                @selected(array_key_exists('show',$filters) && $filters['show'] === 'hide')
            >
                Скрыты
            </option>
        </select>

        <div class="" >
            <input
                type="submit"
                name="submit"
                value="Показать"
                class="
                    bg-blue-800 px-4 py-2 text-white rounded-md
                    cursor-pointer
                    hover:bg-blue-700
                    active:bg-neutral-600
                "
            >
        </div>

        <div class="" >
            <a href="{{ url('education-programs') }}"
                class="
                    inline-block
                    bg-red-800 px-4 py-2 text-white rounded-md
                    cursor-pointer
                    hover:bg-red-700
                    active:bg-neutral-600
                "
            >
                Сбросить
            </a>

        </div>
    </form>

    <section class="main-content mx-4 p-4 bg-white">
        <div class="overflow-x-scroll pb-4">
            <div class="grid gap-4 grid-cols-[auto_auto_auto_auto_1fr] text-center items-center ">
                <div class="font-semibold">
                    Код
                </div>
                <div class="font-semibold text-left">
                    Наименование
                </div>
                <div class="font-semibold">
                    Уровень
                </div>
                <div class="font-semibold">
                    Учебный план
                </div>
                <hr class="col-span-5 last:hidden">
                @foreach($specialities as $speciality)
                    <div class="{{ $loop->iteration % 2 ? "" : '' }}">
                        <a
                            href="{!! $speciality->link !!}"
                            target="_blank"
                            class="underline hover:text-base-red font-semibold {{ $speciality->show ? 'text-green-700' : 'text-red-700' }}"
                        >
                            {!! $speciality->spec_code !!}
                        </a>
                    </div>
                    <div class="text-left flex flex-col gap-2 {{ $loop->iteration % 2 ? "" : '' }}">
                        @if($speciality->relation)
                            {!! $speciality->relation->alt_name ?? $speciality->relation->name !!}
                        @endif

                        <a
                            href="{!! auth()->check() ? $speciality->form : $speciality->link !!}"
                            target="_blank"
                            class="underline hover:text-base-red text-wrap"
                        >
                            {!! $speciality->name !!}
                        </a>
                    </div>
                    <div class="{{ $loop->iteration % 2 ? "" : '' }}">
                        {!! $speciality->level->getName() !!}
                    </div>

                    <div class="grid grid-cols-[200px_150px_auto_auto] items-center gap-3 {{ $loop->iteration % 2 ? "" : '' }}">
                        @foreach($speciality->publicProfiles as $profile)
                            <div class="">
                                {{ $profile->form->getName() }}
                            </div>
                            <div class="">
                                {{ $profile->formated_price }}
                            </div>
                            <div class="grid grid-cols-[50px_100px] gap-2">
                                @if($profile->FormatedDurationOOO)
                                    <div>
                                        OOO
                                    </div>
                                    <div>
                                        {{ $profile->ShortFormatedDurationOOO }}
                                    </div>
                                @endif
                                @if($profile->FormatedDurationSOO)
                                    <div>
                                        СOO
                                    </div>
                                    <div>
                                        {{ $profile->ShortFormatedDurationSOO }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col gap-2">
                                @foreach($speciality->curriculum($profile->form->value) as $doc)
                                    <a
                                        href="{{ $doc->link }}"
                                        target="_blank"
                                        class="underline hover:text-base-red"
                                    >
                                        {{ $doc->title }} ({{ __('education-forms.short.'.$doc->speciality_form) }})
                                    </a>
                                @endforeach
                            </div>

                        @endforeach
                    </div>
                    <hr class="col-span-5 last:hidden">
                @endforeach
            </div>
        </div>
    </section>
@endsection
