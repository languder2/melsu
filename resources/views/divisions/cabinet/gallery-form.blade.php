@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . ' → ' . __('common.Divisions') . ' → ' . $division->name . ' → ' . __('common.Gallery') )

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $division, 'has_menu' => true])@endcomponent
@endsection

@section('content')
    <form action="{{ $division->gallery_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center font-semibold">
                {!! __('common.Gallery') !!}
            </div>

            <div class="flex items-center gap-3">
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

        <div class="bg-white p-3 shadow flex gap-3">
            <x-cabinet.elements.is-approved
                :object=" $division->content('gallery') "
            />
        </div>

        <div class="flex flex-col gap-3 ">
            <x-editorjs.editor
                set="gallery"
                name="content"
                :initialContent=" $division->content('gallery')->content "
            />
        </div>

    </form>
@endsection
