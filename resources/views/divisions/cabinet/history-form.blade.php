@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . ( $division->exists ? $division->name : __('common.New') )  )

@section('content')
    <form action="{{ $division->historySave() }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $division->name . " → " . __('common.History') !!}
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
            <x-editorjs.editor
                set="content"
                name="content"
                :initialContent=" $history "
            />
        </div>
    </form>
@endsection
