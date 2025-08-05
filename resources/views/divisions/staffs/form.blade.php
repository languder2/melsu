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
    <form
        action="{{ $staff->save }}"
        method="POST"
        class="grid gap-3 grid-cols-2"
    >
        @csrf
        @method('PUT')

        <div class="bg-indigo-900/50 p-4">

        </div>

        <div class="bg-white p-4">
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

            <x-form.checkbox.block
                id="form_show"
                name="show"
                :default=" false "
                label="публиковать на сайте"
                :checked=" old('show', $staff->show) "
            />

            <div class="flex flex-row justify-between mt-4">
                @component('components.form.submit',[
                    'name'          => 'save-return',
                    'class'         => "uppercase",
                    'value'         => "сохранить",
                ])@endcomponent

                @component('components.form.submit',[
                    'name'          => 'save-close',
                    'class'         => "uppercase",
                    'value'         => "сохранить и закрыть",
                ])@endcomponent
            </div>

        </div>
    </form>

@endsection
