@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content-header')
    @include('events.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')
    <form action="{{ $event->cabinet_save_link }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>
        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $event->exists ? $event->title : __('news.New events') !!}
            </div>

            <div class="flex items-center gap-3">
                @if( $event->exists )
                    <a href="{{ $event->link }}" target="_blank">
                        <x-lucide-external-link class="w-10 hover:text-blue-800" />
                    </a>
                @endif

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

        <div class="grid grid-cols-1 bp100:grid-cols-2 gap-y-3 bp100:gap-x-3">
            <div class="flex flex-col gap-3 ">
                <div class="flex gap-3">
                    <div>
                        <img src="{{ $event->image->url }}"
                             class="max-h-60 shadow-md"
                        />
                    </div>
                    <div class="flex-1 bg-white p-3 shadow">
                        <x-form.select2
                            id="form_division"
                            name="division"
                            value="{{ $event->relation_id }}"
                            null="Выбрать подразделение"
                            :list=" $divisions "
                        />

                        <x-form.select2
                            id="form_category"
                            name="category_id"
                            value="{{ $event->category }}"
                            null="Выбрать категорию"
                            :list=" $categories "
                        />

                        <x-form.input
                            id="title"
                            name="title"
                            label="Заголовок"
                            value="{!! old('title', $event->title) !!}"
                            required
                        />


                        <div class="flex gap-3 justify-between items-center">
                            <x-form.input
                                type="datetime-local"
                                name="event_datetime"
                                label="Дата и время мероприятия"
                                value="{{ old('published_at', $event->event_datetime ?? now()) }}"
                                block="flex-1"
                                required
                            />

                            <x-form.checkbox.block
                                id="is_show"
                                name="is_show"
                                :default="0"
                                :value="1"
                                label="Опубликовать"
                                :checked=" old('is_show', $event->exists ? $event->is_show : true)"
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
                                    :checked=" old('has_approval', $event->exists ? $event->has_approval : true)"
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
                    :initialContent=" $event->short_text "
                />

            </div>
            <div class="col-span-2 bp100:col-span-1">

                <x-editorjs.editor
                    name="content"
                    heading="Содержание новости"
                    placeholder="Введите содержание новости"
                    :initialContent=" $event->content_text "
                />

            </div>
        </div>
    </form>

@endsection
