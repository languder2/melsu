@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
    @include('documents.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        @if($document->exists)
            Редактирование документа: {{$document->title}}
        @else
            Добавить документ
        @endif
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
            action="{{route('documents:admin:save', $document->exists ? $document->id : null )}}"
            method="POST"
            enctype="multipart/form-data"
            class="flex flex-col gap-4 max-w-1200"
    >
        @csrf

        <x-form.errors setTheme="2"/>

        {{--        @component('staff.admin.include-block') @endcomponent--}}


        <div class="flex flex-col gap-4 p-4 bg-white">
            <x-form.input
                    id="title"
                    name="title"
                    label="Название файла"
                    value="{{ old('_token') ? old('title') : $document->title }}"
                    required
            />

            <x-form.select2
                    id="category_id"
                    name="category_id"
                    :value=" old('_token') ? old('category_id') : $document->category->id ?? $category_id  "
                    null="Категория"
                    :list="$categories"
            />

            <x-form.select2
                    id="parent_id"
                    name="parent_id"
                    :value=" old('_token') ? old('parent_id') : $document->parent->id ?? $parent_id  "
                    null="Привязка к документу"
                    :list="$documents"
            />

            <div class="flex flex-row gap-4 items-center">
                <div class="flex flex-col flex-1">
                    <x-form.input
                            id="form_sort"
                            type="number"
                            step="1"
                            name="sort"
                            label="Порядок вывода"
                            :value="old('_token') ? old('sort') : $document->sort ?? $sort "
                    />
                </div>

                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $document->exists ? $document->is_show : true)"
                    block="pe-2"
                />

                @if(auth()->user()->isEditor())
                    <x-form.checkbox.block
                        id="is_approved"
                        name="is_approved"
                        :default="0"
                        :value="1"
                        label="Утвердить"
                        :checked=" old('is_approved', $document->exists ? $document->is_approved : true)"
                        block="pe-2"
                    />
                @else
                    <input type="hidden" name="has_approval" value="0">
                @endif

            </div>
        </div>

        <div class="flex flex-col gap-4 p-4 bg-white">

            @component('components.form.file',[
                'id'        => 'file',
                'label'     => 'Document',
                'name'      => 'file',
            ])
                @unless($document->exists)
                    @slot('required')
                        true
                    @endslot
                @endunless
            @endcomponent

            @if($document->filetype)
                <a
                        href="{{ Storage::url($document->filename) }}"
                        target="_blank"
                        class="flex gap-4"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="currentColor" class="bi bi-filetype-pdf"
                         viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                    </svg>

                    {{ $document->filename }}
                </a>
            @endif
        </div>

        <x-form.submit
                class="uppercase"
                value="сохранить"
        />
    </form>

@endsection
