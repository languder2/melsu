@extends("layouts.admin")


@if($category->exists)
    @section('title',  __('admin.Admin panel').": ".__('news.Edit news categories').": ".$category->name)
@else
    @section('title',  __('admin.Admin panel').": ".__('news.Create news categories'))
@endif

@section('top-menu')
    @include('news.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        @if($category->exists)
            {{ __('news.Edit news categories') }}: {!! $category->name !!}
        @else
            Добавить документ
        @endif
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{ $category->save }}"
        method="POST"
        enctype="multipart/form-data"
        class="flex flex-col gap-4 max-w-1200"
    >
        @csrf

        <x-form.errors setTheme="2"/>

        <div class="flex flex-col gap-4 p-4 bg-white">
            <x-form.input
                id="name"
                name="name"
                label="Название категории (Уникальное)"
                value="{{ old('_token') ? old('name') : $category->name }}"
                required
            />

            <x-form.input
                id="code"
                name="code"
                label="Alias (Уникальное, для использования в адресной строке)"
                value="{{ old('_token') ? old('code') : $category->code }}"
            />

            <x-form.input
                id="form_sort"
                type="number"
                step="1"
                name="sort"
                label="Порядок вывода"
                :value="old('_token') ? old('sort') : $category->sort ?? $sort ?? null "
            />
        </div>

        <x-form.submit
            class="uppercase"
            value="сохранить"
        />
    </form>

@endsection
