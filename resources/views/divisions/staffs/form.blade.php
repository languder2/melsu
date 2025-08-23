@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('top-menu')
    @include('divisions.admin.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex flex-col gap-2 justify-between">
            <div class="flex gap-4">
                <a href="{{ $division->link }}" class="underline hover:text-red" target="_blank">
                    {{ $division->name }}
                </a>
                <div>
                    →
                </div>
                <div>
                    Сотрудники
                </div>
            </div>
            <div>
                {!! $staff->exists ? "{$staff->post}: {$staff->card->full_name}" : __('staffs.new') !!}
            </div>
        </div>
    @endcomponent
@endsection

@section('content')
    <div
        class="grid gap-3 grid-cols-2"
    >
        <div class="bg-white p-4">
            <x-divisions.staff-select />
        </div>

        <form
            action="{{ $staff->save }}"
            method="POST"
            class="bg-white p-4"
        >
            @csrf
            @method('PUT')

            <input id="form_staff_id" type="hidden" name="staff_id" value="{{ $staff->card->id }}">

            <x-form.input
                id="form_lastname"
                name="lastname"
                label="Фамилия"
                value="{!! old('lastname', $staff->card->lastname) !!}"
                required
            />

            <x-form.input
                id="form_firstname"
                name="firstname"
                label="Имя"
                value="{!! old('firstname', $staff->card->firstname) !!}"
                required
            />

            <x-form.input
                id="form_middle_name"
                name="middle_name"
                label="Отчество"
                value="{!! old('middle_name', $staff->card->middle_name) !!}"
            />

            <x-form.input
                id="form_post"
                name="post"
                label="Должность"
                value="{!! old('post', $staff->post) !!}"
            />

            <x-form.input
                id="form_post_alt"
                name="post_alt"
                label="Должность полностью"
                value="{!! old('post_alt', $staff->post_alt) !!}"
            />


            <div class="flex gap-2 justify-between flex-col xl:flex-row">
                <x-form.input
                    id="form_order"
                    name="order"
                    type="number"
                    label="Порядок вывод"
                    value="{!! old('order', $staff->order) !!}"
                    block="flex-1"
                />

                <x-form.checkbox.block
                    id="form_show"
                    name="show"
                    :default="0"
                    :value="1"
                    label="Публиковать на странице подразделения"
                    :checked=" old('show', $staff->exists ? $staff->show : true ) "
                />
            </div>

            <div class="flex gap-2 justify-between flex-col xl:flex-row">
                <x-form.input
                    id="form_post_weight"
                    name="post_weight"
                    type="number"
                    label="Вес должности в порядке вывода"
                    value="{!! old('post_weight', $staff->post_weight ) !!}"
                    block="flex-1"
                />

                <x-form.checkbox.block
                    id="form_post_show"
                    name="post_show"
                    :default="0"
                    :value="1"
                    label="Учитывать в списке должностей"
                    :checked=" old('post_show', $staff->exists ? $staff->post_show : true ) "
                />
            </div>




            <div class="flex gap-x-4 justify-between">

                @if($staff->relation->type && $staff->relation->type->name === "Department")
                    <x-form.checkbox.block
                        id="form_is_teacher"
                        name="is_teacher"
                        :default="0"
                        :value="1"
                        label=" Должность подразумевает преподавание "
                        :checked=" old('is_teacher', $staff->exists ? $staff->is_teacher : true ) "
                    />
                @else
                    <div></div>
                @endif

                <x-form.checkbox.block
                    id="form_new"
                    name="new"
                    :default="0"
                    :value="1"
                    label=" Создать запись сотрудника "
                    block="justify-end"
                />
            </div>

            <div class="flex flex-row justify-end mt-4">
                @component('components.form.submit',[
                    'name'          => 'save-close',
                    'class'         => "uppercase",
                    'value'         => "сохранить",
                ])@endcomponent
            </div>

        </form>
    </div>

@endsection
