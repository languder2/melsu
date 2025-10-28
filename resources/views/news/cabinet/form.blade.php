@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content')
    <form action="{{ $news->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>
        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $news->exists ? $news->title : __('news.New news') !!}
            </div>

            <div class="flex items-center gap-3">
                @if( $news->exists )
                    <a href="{{ $news->link }}" target="_blank">
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

        <div class="grid grid-cols-1 bp100:grid-cols-2 gap-y-3 bp100:gap-x-3">
            <div class="flex flex-col gap-3 ">
                <div class="flex gap-3">
                    <div>
                        <img src="{{$news->preview->thumbnail}}" alt="1"
                             class="max-h-60 shadow shadow-md"
                        />
                    </div>
                    <div class="flex-1 bg-white p-3 shadow">
                        <x-form.select2
                            id="form_division"
                            name="division"
                            value="{{ $news->relation_id }}"
                            null="Выбрать подразделение"
                            :list=" $divisions "
                        />

                        <x-form.select2
                            id="form_category"
                            name="category"
                            value="{{ $news->category }}"
                            null="Выбрать категорию"
                            :list=" $categories "
                        />

                        <x-form.input
                            id="title"
                            name="title"
                            label="Заголовок"
                            value="{!! old('title', $news->title) !!}"
                            required
                        />


                        <div class="flex gap-3 justify-between items-center">
                            <x-form.input
                                id="published_at"
                                type="datetime-local"
                                name="published_at"
                                label="Дата публикация"
                                value="{{ old('published_at', $news->published_at ?? now()) }}"
                                block="flex-1"
                            />

                            <x-form.checkbox.block
                                id="is_show"
                                name="is_show"
                                :default="0"
                                :value="1"
                                label="Опубликовать"
                                :checked=" old('is_show', $news->exists ? $news->is_show : true)"
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
                                    :checked=" old('has_approval', $news->exists ? $news->has_approval : true)"
                                    block="pe-2"
                                />
                            @else
                                <input type="hidden" name="has_approval" value="0">
                            @endif
                        </div>
                    </div>
                </div>

                <x-editorjs.editor
                    set="short"
                    heading="Краткое описание новости"
                    name="short"
                    :initialContent=" $news->short_data "
                />

            </div>
            <div class="col-span-2 bp100:col-span-1">

                <x-editorjs.editor
                    name="content"
                    heading="Содержание новости"
                    placeholder="Введите содержание новости"
                    :initialContent=" $news->content_data "
                />

            </div>
        </div>
    </form>

@endsection
