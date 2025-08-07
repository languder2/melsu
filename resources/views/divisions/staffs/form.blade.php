@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex flex-col gap-2 justify-between">
            <div>
                {{ $division->name }}
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
            <x-divisions.staff-select
                :staff="3133123"
            />
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
                required
            />

            <x-form.input
                id="form_post"
                name="post"
                label="Должность"
                value="{!! old('post', $staff->post) !!}"
                required
            />

            <x-form.input
                id="form_post_alt"
                name="post_alt"
                label="Должность полностью"
                value="{!! old('post_alt', $staff->post_alt) !!}"
                required
            />

            <x-form.input
                id="form_order"
                name="order"
                type="number"
                label="Порядок вывод"
                value="{!! old('order', $staff->order) !!}"
            />

            <div class="flex gap-2 justify-between">
                <x-form.checkbox.block
                    id="form_show"
                    name="show"
                    :default=" false "
                    label="Публиковать на сайте"
                    :checked=" old('show', $staff->exists ? $staff->show : true ) "
                />

                <x-form.checkbox.block
                    id="form_new"
                    name="new"
                    :default=" false "
                    label=" Создать запись сотрудника "
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
