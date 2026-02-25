@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". __('common.Documents')
    ." → ". ($current->exists ? $current->name : __('common.Add documents category'))

)

@section('content-header')
    @include('documents.cabinet.menu')
@endsection

@section('content')

    <form action="{{ route('documents.cabinet.category.save', compact('current')) }}"
          method="POST"
          class="flex flex-col gap-3"
          enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $current->exists ? $current->name : __('common.Add documents category') !!}
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
            <div class="flex gap-3">
                <x-form.input
                    name="name"
                    label="Название"
                    value="{!! old('name', $current->name) !!}"
                    block="flex-1"
                />

                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $current->exists ? $current->is_show : true)"
                    block="pe-2"
                />

                @if(auth()->user()->isEditor())
                    <x-form.checkbox.block
                        id="is_approved"
                        name="is_approved"
                        :default="0"
                        :value="1"
                        label="Утвердить"
                        :checked=" old('is_approved', $current->exists ? $current->is_approved : true)"
                        block="pe-2"
                    />
                @else
                    <input type="hidden" name="has_approval" value="0">
                @endif
            </div>
        </div>


        <div class="flex flex-col gap-3 bg-white p-3 shadow">
            <x-form.checkbox.block
                name="show_documents"
                :default="0"
                :value="1"
                label="По умолчанию категория развернута"
                :checked=" old('show_documents', $current->option('show_documents')->exists ? $current->option('show_documents')->property : true)"
                block="pe-2"
                class="py-2"
            />
        </div>

        <div class="group bg-white p-3 shadow flex gap-3">
            <div>
                <x-form.checkbox.block
                    id="inAccordion"
                    name="in_accordion"
                    :default="0"
                    :value="1"
                    label="Состоит в группе аккордеона"
                    :checked=" old('in_accordion', $current->option('in_accordion')->exists ?: false) "
                    block="pe-2"
                    class="py-2"
                />
            </div>

            <x-form.input
                id="accordionPrefix"
                name="accordion_prefix"
                label="Префикс группы аккордеона"
                value="{!! old('accordion_prefix', $current->option('accordion_prefix')->property) !!}"
                block="flex-1"
                :disabled=" !$current->option('in_accordion')->exists ?: false "
                required
            />
        </div>

        <h3 class="font-semibold text-xl lg:col-span-2 my-2">
            Краткое описание
        </h3>
        <x-editorjs.editor
            set="short"
            name="short"
            :initialContent=" $current->content('short')->content "
        />

    </form>

@endsection
