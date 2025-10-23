@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . ( $division->exists ? $division->name : __('common.New') )  )

@section('content')

    <form id="formWithEditorJS" action="{{ $division->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>
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

            <div class="flex flex-col gap-3 ">
                <div class="flex gap-3">
                    <div>
                        <img src="{{$division->preview->thumbnail}}" alt="1"
                             class="max-h-60 shadow-md"
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
                            required
                        />


                        <div class="flex gap-3 justify-between items-center">
                            <x-form.input
                                id="published_at"
                                type="datetime-local"
                                name="published_at"
                                label="Дата публикация"
                                value="{{ old('published_at', $division->published_at ?? now()) }}"
                                block="flex-1"
                            />

                            <x-form.checkbox.block
                                id="is_show"
                                name="is_show"
                                :default="0"
                                :value="1"
                                label="Опубликовать"
                                :checked=" old('is_show', $division->exists ? $division->is_show : true)"
                                block="pe-2"
                            />
                        </div>


                        <div class="flex gap-3">
                            <x-form.file
                                id="form_image"
                                label="Установить / сменить изображение"
                                name="image"
                                block="flex-1"
                            />

                            @if(auth()->user()->isEditor())
                                <x-form.checkbox.block
                                    id="has_approval"
                                    name="has_approval"
                                    :default="0"
                                    :value="1"
                                    label="Утвердить"
                                    :checked=" old('has_approval', $division->exists ? $division->has_approval : true)"
                                    block="pe-2"
                                />
                            @else
                                <input type="hidden" name="has_approval" value="0">
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-xl">Описание</h4>

                    <div class="w-full bg-white p-4 ps-10">
                        <input type="hidden" id="EditorJSShort" name="short">
                        <div id="EditorJSShortBlock" class=" ps-6"
                             data-initial-content="{{ $division->short_data }}"
                        >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 bp100:col-span-1">
                <div>
                    <h4 class="font-semibold text-xl">Содержание новости</h4>

                    <div class="w-full bg-white p-4 ps-10">
                        <input type="hidden" id="editorJSContent" name="content">
                        <div
                            id="editorJSContentBlock"
                            class="ps-6"
                            data-initial-content="{{ $division->content_data }}"
                        >
                        </div>
                    </div>

                </div>
            </div>
    </form>

    @dump($division)

@endsection
