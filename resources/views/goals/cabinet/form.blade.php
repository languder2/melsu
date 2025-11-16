@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". $instance->name ." → "
    .($goal->exists ? __("common.Goal") ."#$goal->id" : __("common.Add goal"))
)

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true ])@endcomponent
    @include('goals.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')
    <form action="{{ $goal->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>
        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $goal->exists ? __('common.Goal')." #$goal->id" : __('common.Add goal') !!}
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

        <div class="flex flex-col gap-3 ">
            <div class="bg-white p-3 shadow flex gap-3">

                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $goal->exists ? $goal->is_show : true)"
                    block="pe-2"
                />

                @if(auth()->user()->isEditor())

                    <x-form.checkbox.block
                        id="is_approved"
                        name="is_approved"
                        :default="0"
                        :value="1"
                        label="Утвердить"
                        :checked=" old('is_approved', $goal->exists ? $goal->is_approved : true)"
                        block="pe-2"
                    />
                @else
                    <input type="hidden" name="has_approval" value="0">
                @endif
            </div>

            <x-editorjs.editor
                set="short"
                heading="Текст"
                name="content"
                :initialContent=" $goal->content "
            />
        </div>
    </form>

@endsection
