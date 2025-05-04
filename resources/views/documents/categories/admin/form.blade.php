@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
    @include('documents.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        @if($category->id)
            Редактирование категории:  {{$category->full_name}}
        @else
            Добавить категорию
        @endif
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
            action="{{route('document-categories:admin:save',$category)}}"
            method="POST"
            enctype="multipart/form-data"
            class="flex flex-col gap-4 max-w-1200"
    >
        @csrf

        <x-form.errors setTheme/>

        <div class="p-4 bg-white flex flex-col gap-4">
            <x-form.input
                    id="name"
                    name="name"
                    label="Название категории"
                    value="{{ old('_token') ? old('name') : $category->name }}"
                    required
            />
            <div class="flex flex-row gap-4 items-center">
                <div class="flex-1">
                    <x-form.input
                            id="form_sort"
                            type="number"
                            step="1"
                            name="sort"
                            label="Порядок вывода"
                            :value="old('_token') ? old('sort') : $category->sort ?? $sort "
                    />
                </div>
                <x-form.radio.on-off
                        name="is_show"
                        :value="old('_token') ? old('is_show') : ($category->id ? $category->is_show : true)"
                />
            </div>
        </div>

        <x-form.submit
                class="uppercase"
                value="сохранить"
        />
    </form>
@endsection
