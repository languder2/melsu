@extends("layouts.cabinet")

@section('title', __('common.Cabinet') ." → " . __('common.Pages') . " → " .  __('common.Form') . " → " . ( $page->exists ? $page->name : __('common.New page') )  )

@section('content')
    <form action="{{ $page->cabinet_save_link }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $page->exists ? $page->name : __('common.New page') !!}
            </div>

            <div class="flex items-center gap-3">
                @if( $page->exists )
                    <a href="{{ $page->link }}" target="_blank">
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

                <x-form.input
                    name="name"
                    label="Название"
                    value="{!! old('name', $page->name) !!}"
                    required
                />

                <x-form.input
                    name="code"
                    label="Code / Alias"
                    value="{!! old('code', $page->code) !!}"
                    required
                />

                <div class="flex gap-3 justify-between items-center">
                    <x-form.checkbox.block
                        id="is_show"
                        name="is_show"
                        :default="0"
                        :value="1"
                        label="Опубликовать"
                        :checked=" old('show', $page->exists ? $page->is_show : true)"
                        block="pe-2"
                    />
                </div>

            </div>

            <div class="flex gap-3 bg-white p-3 shadow">
                <div>
                    <x-html.image-with-modal
                        :url="$page->image->url"
                        object="max-h-14"
                    />
                </div>

                <x-form.file
                    label="Установить / сменить изображение для шапки раздела"
                    name="image"
                    block="flex-1"
                />
            </div>

            <x-common.meta-form
                :meta="$page->meta"
                header="Метатеги"
            />

            <x-editorjs.editor
                set="content"
                name="content"
                :initialContent=" $page->content "
            />
        </div>
    </form>
@endsection
