@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        @if($member->id)
            Редактирование участника полка {{$member->full_name}}
        @else
            Добавить участника полка
        @endif
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{route('regiment:admin:save',$member)}}"
        method="POST"
        enctype="multipart/form-data"
        class="flex flex-col gap-4 max-w-1200"
    >
        @csrf

        <x-form.errors setTheme />

{{--        @component('staff.admin.include-block') @endcomponent--}}

        <div class="flex flex-row justify-between gap-4">

            @if($member->image)
                <img
                    src="{{ $member->image->preview }}"
                    alt=""
                    class="h-72"
                >
            @endif

            <div class="flex flex-col gap-4 flex-1 p-4 bg-stone-50">
                <h3 class="font-semibold text-lg">
                    ФИО:
                </h3>
                <x-form.input
                    id="lastname"
                    name="lastname"
                    label="Фамилия"
                    value="{{ old('_token') ? old('lastname') : $member->lastname }}"
                    required
                />

                <x-form.input
                    id="firstname"
                    name="firstname"
                    label="Имя"
                    value="{{ old('_token') ? old('firstname') : $member->firstname }}"
                    required
                />

                <x-form.input
                    id="middle_name"
                    name="middle_name"
                    label="Отчество"
                    value="{{ old('_token') ? old('middle_name') : $member->middle_name }}"
                />
            </div>
        </div>

        <div class="flex flex-col gap-4 p-4 bg-stone-50">
            <x-form.file
                id="image"
                label="Photo"
                name="image"
            />

            <x-form.input
                id="gallery_image"
                name="gallery_image"
                label="Картинка из галереи"
                :value="old('_token') ? old('gallery_image') : $member->image->src ?? null "
            />
        </div>

        <div class="flex flex-row gap-4 items-center">
            <div class="flex flex-col p-4 bg-stone-50 flex-1">
                <x-form.select2
                    id="type"
                    name="type"
                    nullDisabled
                    :value=" old('_token') ? old('type') : $member->type->name ?? null  "
                    null="Выберите полк"
                    :list="$regiments"
                    required
                />
            </div>
            <x-form.radio.on-off
                name="is_show"
                :value="old('_token') ? old('is_show') : ($member->id ? $member->is_show : true)"
            />
        </div>

        <div class="p-4 bg-stone-50">
            <x-form.editor
                name="content"
                id="content"
                label="Текст"
                :value="old('_token') ? old('content') : $member->content"
                class="min-h-600"
            />
        </div>


        <x-form.submit
            class="uppercase"
            value="сохранить"
        />
    </form>
@endsection

