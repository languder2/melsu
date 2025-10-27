@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . ( $division->exists ? $division->name : __('common.New') )  )

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
            <div class="grid grid-cols-[auto_1fr] gap-3">
                <div class="max-h-72 bg-red-700/20">
                    <img src="{{$division->preview->thumbnail}}" alt="1"
                         class="h-full drop-shadow-md"
                    />
                </div>
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
                        id="name"
                        name="name"
                        label="Название"
                        value="{!! old('name', $division->name) !!}"
                        required1
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


                    <div class="flex gap-3 justify-between items-center">
                        <x-form.file
                            id="form_image"
                            label="Установить / сменить изображение"
                            name="image"
                            block="flex-1"
                        />

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
            </div>

            <x-editorjs.editor
                set="content"
                name="content"
                :initialContent=" $division->content "
            />
        </div>
    </form>
@endsection
