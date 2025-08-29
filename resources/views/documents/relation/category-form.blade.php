@extends("layouts.admin")

@section('title', "Админ панель: $relation->name: ".__('documents.Documents'))

@if($relation->adminMenu())
    @section('top-menu')
        @include($relation->adminMenu())
    @endsection
@endif

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex flex-col gap-2 justify-between">
            <div class="flex gap-4">
                <a href="{{ $relation->link }}" class="underline hover:text-red" target="_blank">
                    {{ $relation->name }}
                </a>
                <div>
                    →
                </div>
                <div>
                    <a
                        href="{{ $relation->links['admin'] }}"
                        class="underline"
                    >
                        {{ __('documents.Documents') }}
                    </a>
                </div>
            </div>
            <div>
                {!! $category->exists ? "$category->name" : __('documents.NewCategory') !!}
            </div>
        </div>
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{ $category->links['save'] }}"
        method="POST"
        enctype="multipart/form-data"
        class="flex flex-col gap-4 max-w-1200"
    >
        @csrf
        @method('PUT')

        <x-form.errors setTheme/>

        <input type="hidden" name="relation_type"   value="{{ $relation ? $relation::class : null }}">
        <input type="hidden" name="relation_id"     value="{{ $relation ? $relation->id : null }}">

        <div class="p-4 bg-white flex flex-col gap-4">
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

    @dump($category->links)

@endsection
