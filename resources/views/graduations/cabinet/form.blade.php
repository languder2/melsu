@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". $instance->name ." → "
    .($graduation->exists ? $graduation->name: __("common.Add career"))
)

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true])@endcomponent
    @include('graduations.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')
    <form action="{{ $graduation->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap3 bg-white p-3 ps-5 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center font-semibold">
                {!! $graduation->exists ? $graduation->name : __('common.Add graduation') !!}
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

        <div class="flex flex-col gap-3">
            <div class="bg-white p-3 shadow flex gap-3 flex-wrap">
                <x-form.input
                    name="name"
                    :label="__('common.Name')"
                    value="{!! old('name', $graduation->name) !!}"
                    block="w-full"
                    required
                />

                <x-form.input
                    name="link"
                    :label="__('common.link')"
                    value="{!! old('link', $graduation->link) !!}"
                    block="w-full capitalize"
                />

                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $graduation->exists ? $graduation->is_show : true)"
                    block="pe-2"
                />

                @if(auth()->user()->isEditor())

                    <x-form.checkbox.block
                        id="is_approved"
                        name="is_approved"
                        :default="0"
                        :value="1"
                        label="Утвердить"
                        :checked=" old('is_approved', $graduation->exists ? $graduation->is_approved : true)"
                        block="pe-2"
                    />
                @else
                    <input type="hidden" name="has_approval" value="0">
                @endif
            </div>

            <div class="flex gap-3 bg-white p-3 shadow">
                <div>
                    <x-html.image-with-modal
                        :url="$graduation->image->url"
                        object="max-h-14"
                    />
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
                heading="Содержание страницы"
                name="content"
                :initialContent=" $graduation->content "
            />
        </div>
    </form>

@endsection
