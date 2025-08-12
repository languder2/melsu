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
                    <a
                        href="{{ $division->documents_admin_list }}"
                        class="underline"
                    >
                        {{ __('documents.Documents') }}
                    </a>
                </div>
            </div>
            <div>
                {!! $category->exists ? "{$category->name}" : __('documents.NewCategory') !!}
            </div>
        </div>
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{ $category->relation_document_category_save }}"
        method="POST"
        enctype="multipart/form-data"
        class="flex flex-col gap-4 max-w-1200"
    >
        @csrf
        @method('PUT')

        <x-form.errors setTheme/>

        <div class="p-4 bg-white flex flex-col gap-4">
{{--            <x-form.select2--}}
{{--                id="parent_id"--}}
{{--                name="parent_id"--}}
{{--                :value="old('parent_id', $category->parent_id) "--}}
{{--                null="Родительская категория"--}}
{{--                :list="$list"--}}
{{--            />--}}

            <x-form.input
                id="name"
                name="name"
                label="Название категории"
                value="{{ old('name', $category->name) }}"
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
                        :value="old('sort', $category->sort ?? $sort)"
                    />
                </div>
                <x-form.radio.on-off
                    name="is_show"
                    :value="old('is_show', $category->id ? $category->is_show : true)"
                />
            </div>
        </div>

        <x-form.submit
            class="uppercase"
            value="сохранить"
        />
    </form>

@endsection
