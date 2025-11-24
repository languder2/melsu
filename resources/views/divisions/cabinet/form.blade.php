@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . ( $division->exists ? $division->name : __('common.New') )  )

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $division, 'has_menu' => true])@endcomponent
@endsection

@section('content')
    <form action="{{ $division->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $division->exists ? $division->name : __('common.New') !!}
            </div>

            <div class="flex items-center gap-3">
                @if( $division->exists )
                    <a href="{{ $division->link }}" target="_blank">
                        <x-lucide-external-link class="w-10 hover:text-blue-800" />
                    </a>
                @endif

                <input
                    type="submit"
                    value="Сохранить"
                    class="
                        bg-blue-900
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
                        bg-blue-900
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

        <x-form.errors setTheme="2"/>

        <div class="flex flex-col gap-3 ">
            <div class="flex-1 bg-white p-3 shadow">
                <x-form.select2
                    id="form_parent_id"
                    name="parent_id"
                    value="{{ old('name', $division->parent_id) }}"
                    null="Родительское подразделение"
                    :list=" $divisions ?? [] "
                />

                <x-form.select2
                    id="form_type"
                    name="type"
                    value="{{ old('name', $division->type) }}"
                    null="Выбрать тип подразделения"
                    :list=" $types "
                />

                <x-form.input
                    name="name"
                    label="Название"
                    value="{!! old('name', $division->name) !!}"
                    required
                />

                <div class="flex flex-col md:flex-row gap-3">
                    <x-form.input
                        name="acronym"
                        label="Акроним"
                        value="{!! old('acronym', $division->acronym) !!}"
                        block="w-24"
                    />

                    <x-form.input
                        name="alt_name"
                        label="Сокращенное название"
                        value="{!! old('alt_name', $division->alt_name) !!}"
                        block="flex-1"
                    />

                </div>

                <x-form.input
                    name="code"
                    label="Code / Alias"
                    value="{!! old('code', $division->code) !!}"
                />

                @if(auth()->user()->isAdmin())
                    <x-form.input
                        name="uuid"
                        label="UUID"
                        value="{!! old('uuid', $division->uuid) !!}"
                    />
                @endif

                <div class="flex gap-3 justify-between items-center">

                    <x-form.checkbox.block
                        id="is_show"
                        name="is_show"
                        :default="0"
                        :value="1"
                        label="Опубликовать"
                        :checked=" old('show', $division->exists ? $division->show : true)"
                        block="pe-2"
                    />
                </div>

            </div>

            <div class="flex gap-3 bg-white p-3 shadow">
                <div>
                    <x-html.image-with-modal
                        :url="$division->image->url"
                        object="max-h-14"
                    />
                </div>

                <x-form.file
                    label="Установить / сменить изображение для шапки раздела"
                    name="image"
                    block="flex-1"
                />
            </div>

            <div class="flex gap-3 bg-white p-3 shadow">
                <div>
                    <x-html.image-with-modal
                        :url="$division->preview->src"
                        object="max-h-14"
                    />
                </div>

                <x-form.file
                    label="Установить / сменить изображение для списка"
                    name="preview"
                    block="flex-1"
                />
            </div>

            <x-common.meta-form
                :meta="$division->meta"
                header="Метатеги"
            />

            <x-editorjs.editor
                set="content"
                name="content"
                :initialContent=" $division->content "
            />
        </div>
    </form>
@endsection
