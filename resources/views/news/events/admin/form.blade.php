@extends("layouts.admin")

@section('top-menu')
    @include('news.menu')
@endsection

@if(empty($event->id))
    @section('title', 'Админ панель: Мероприятие: Новое')
    @section('header')
        <h2 class="flex-1 text-xl font-semibold bg-white p-3">
            Создать мероприятие
        </h2>
    @endsection
@else
    @section('title', "Админ панель: Мероприятие: Редактирование: {$event->title}")
    @section('header')
        <h2 class="flex-1 text-xl font-semibold bg-white p-3">
            Редактирование мероприятия: {!! $event->title !!}
        </h2>
    @endsection
@endif

@section('content')
    <x-head.tinymce-config/>
    <form
            action="{{route('admin:events:save',[$event])}}"
            method="POST"
            enctype="multipart/form-data"
            class=" max-w-1200 mx-auto flex flex-col gap-4"
    >
        @csrf

        <x-form.errors/>

        <x-form.input type="hidden" name="id" value="{{ $event->id ?? null }}"/>

        <div class="flex gap-4 p-4 bg-white">

            @if($event->preview && $event->preview->src)
                <div>
                    <img src="{{$event->preview->src}}" alt="1"
                        class="max-h-68"
                    />
                </div>
            @elseif(optional($event)->image)
                <div>
                    <img src="{{$event->image}}" alt="1"
                        class="max-h-68"
                    />
                </div>
            @endif

            <div class="flex-1">
                <x-form.input
                        id="title"
                        name="title"
                        label="Заголовок"
                        value="{{old('title')??@$event->title}}"
                        required
                />

                <x-form.select
                        id="type"
                        name="type"
                        nullDisabled
                        old="{{ old('type') }}"
                        value="{{ $event->type ?? null}}"
                        null="Выберите тип (анонс/мероприятие)"
                        :list="$types"
                        required
                />

                <x-form.select
                        id="category_id"
                        name="category_id"
                        nullDisabled
                        old="{{ old('category_id', $event->category_id) }}"
                        value="{{@$current->category_id}}}"
                        null="Выберите категорию"
                        :list="$categories??[]"
                        required
                />

                <x-form.input
                        id="published_at"
                        type="datetime-local"
                        name="published_at"
                        label="Дата публикация"
                        value="{{old('post')??($event?->getAttributes()['published_at']??now())}}"
                />

                
    <x-form.input
        id="event_datetime"
        type="datetime-local"
        name="event_datetime"
        label="Дата проведения"
        value="{{ old('event_datetime', $event->event_datetime instanceof \Carbon\Carbon ? $event->event_datetime->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
/>

                <x-form.file
                        id="form_image"
                        label="Preview"
                        name="image"
                />

                <x-form.input
                        id="form_preview"
                        name="preview"
                        label="Картинка из галереи"
                        value="{{old('preview')??optional(optional($event)->preview)->src}}"
                />

            </div>
        </div>

        <div class="p-4 bg-white">
            <x-form.editor
                    name="short"
                    id="short"
                    label="Краткое описание"
                    value="{{old('short') ?? $event->short}}"
            />
        </div>

        <div class="p-4 bg-white">
            <x-form.editor
                    name="full"
                    id="full"
                    label="Полное описание"
                    borderTop
                    value="{{old('full') ?? $event->full}}"
            />
        </div>


        <div class="p-4 bg-white">
            <x-form.editor
                    name="news"
                    id="news"
                    label="Новость"
                    value="{{old('news') ?? $event->news ?? null}}"
                    borderTop
                    class="min-h-80"
            />
        </div>

        <x-form.submit
                class="uppercase"
                value="сохранить"
        />

    </form>

@endsection
