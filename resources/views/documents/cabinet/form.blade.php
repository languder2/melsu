@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". $instance->name ." → "
    .($partner->exists ? $partner->name : __("common.Add partner"))
)

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true])@endcomponent
    @include('partners.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')
    <form action="{{ $partner->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap-3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $partner->exists ? $partner->name : __('common.Add partner') !!}
            </div>

            <div class="flex items-center gap-3">
                <input
                    type="submit"
                    value="Сохранить"
                    class="
                        bg-sky-800
                        px-4 py-2
                        text-white
                        rounded-md
                        hover:bg-blue-700

                        active:bg-gray-700
                        cursor-pointer
                        uppercase
                    "
                >
                <input
                    type="submit"
                    name="save-close"
                    value="Сохранить и закрыть"
                    class="
                        uppercase
                        bg-sky-800
                        px-4 py-2
                        text-white
                        rounded-md
                        hover:bg-blue-700
                        active:bg-gray-700
                        cursor-pointer
                    "
                >
            </div>
        </div>


        <div class="flex flex-col gap-3 bg-white p-3 shadow">
            <x-form.select2
                name="category_id"
                value="{{ old('category_id', $partner->category_id) }}"
                null="Категория"
                class="flex-1"
                :list=" $categories->pluck('name', 'id') "
            />

            <x-form.input
                name="name"
                label="Название"
                value="{!! old('name', $partner->name) !!}"
                block="flex-1"
                required
            />

            <x-form.input
                name="link"
                label="Ссылка"
                value="{!! old('link', $partner->link) !!}"
                block="flex-1"
            />

            <div class="flex gap-3">
{{--                <x-form.input--}}
{{--                    name="sort"--}}
{{--                    type="number"--}}
{{--                    label="Порядок вывода (Убывающий порядок)"--}}
{{--                    value="{!! old('sort', $partner->sort) !!}"--}}
{{--                    block="flex-1"--}}
{{--                />--}}

                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $partner->exists ? $partner->is_show : true)"
                    block="pe-2"
                />

                @if(auth()->user()->isEditor())
                    <x-form.checkbox.block
                        id="is_approved"
                        name="is_approved"
                        :default="0"
                        :value="1"
                        label="Утвердить"
                        :checked=" old('is_approved', $partner->exists ? $partner->is_approved : true)"
                        block="pe-2"
                    />
                @else
                    <input type="hidden" name="has_approval" value="0">
                @endif
            </div>
        </div>

        <div class="flex gap-3 bg-white p-3 shadow">
            <div>
                <img src="{{$partner->image->url}}" alt="" class="h-14">
            </div>
            <x-form.file
                id="form_image"
                label="Установить / сменить изображение"
                name="image"
                block="flex-1"
            />
        </div>


        <x-editorjs.editor
            set="content"
            heading="Текст"
            name="content"
            :initialContent=" $partner->content "
        />
    </form>

@endsection
