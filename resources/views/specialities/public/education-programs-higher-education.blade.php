@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
        {!!Breadcrumbs::view("vendor.breadcrumbs.base",'education-programs:higher-education')!!}
@endsection

@section('content')
    <section class="main-content mx-4 p-4 bg-white">
        <div class="overflow-x-scroll pb-4">
            <div class="grid gap-4 grid-cols-[auto_auto_auto_auto_auto] text-center items-center">
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
                    Форма
                </div>
                <div class="font-semibold">
                    Учебный план
                </div>
                <hr class="col-span-5 last:hidden">
                @foreach($specialities as $speciality)
                    @foreach($speciality->publicProfiles as $profile)
                        <div>
                            <a
                                href="{!! $speciality->link !!}"
                                target="_blank"
                                class="underline hover:text-base-red"
                            >
                                {!! $speciality->spec_code !!}
                            </a>
                        </div>
                        <div class="text-left">
                            <a
                                href="{!! $speciality->link !!}"
                                target="_blank"
                                class="underline hover:text-base-red"
                            >
                                {!! $speciality->name !!}
                            </a>
                        </div>
                        <div>
                            {!! $speciality->level->getName() !!}
                        </div>
                        <div>
                            {!! $profile->form->getName() !!}
                        </div>
                        <div class="flex flex-col gap-3">
                            @foreach($speciality->curriculum($profile->form->value) as $doc)
                                <a
                                    href="{{ $doc->link }}"
                                    target="_blank"
                                    class="underline hover:text-base-red"
                                >
                                    {{ $doc->title }}
                                </a>
                            @endforeach
                        </div>
                        <hr class="col-span-5 last:hidden">
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection
