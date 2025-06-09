@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-admin.education.specialities.header />
@endsection

@section('filter')
    <x-specialities.admin.filters />
@endsection

@section('content')

<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_auto_1fr_auto_1fr_1fr_auto_auto_auto]
        "
    >
        <div class="font-semibold text-center">
            ID
        </div>

        <div class="font-semibold">
            Уровень
        </div>

        <div class="font-semibold">
            Кафедра
        </div>

        <div class="font-semibold">
            Код
        </div>

        <div class="font-semibold md:col-span-2">
            Наименование
        </div>

        <div class="font-semibold">
            Ссылка
        </div>

        <div class="font-semibold">
            Формы
        </div>

        <div></div>

        @each('specialities.admin.item',$list,'record')
    </div>
</div>

{{--    --}}
{{--    @each('specialities.admin.section',$list,'section')--}}

{{--    @include('specialities.admin.section-with-parent',['list'=>$spo,'name'=>'СПО'])--}}

{{--    @include('specialities.admin.section-with-parent',['list'=>$pg,'name'=>'Аспирантура'])--}}

@endsection



