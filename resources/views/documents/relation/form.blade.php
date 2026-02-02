@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". $instance->name ." → "
    .($document->exists ? $document->name : __("common.Add partner"))
)

@section('content-header')
    {{--    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true])@endcomponent--}}
    @include('documents.relation.menu')
@endsection

@section('top-menu')

@endsection

@section('content')

    <form action="{{ route('documents.relation.save', [$instance->getTable(), $instance->id, $document]) }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>
        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {{ $instance->name }}
                →
                {!! $document->exists ? $document->name : __('common.Add documents category') !!}
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

        <div class="flex flex-col gap-2 p-4 bg-white">
            <p>Категория</p>
            <select class="jq-select2" name="category_id" required>
                <option value="">Категория не выбрана</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected($document->exists ? $document->category_id === $category->id : $category_id === $category->id )
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-2 p-4 bg-white">
            <p>Приложить к документу</p>
            <select class="jq-select2" name="parent_id">
                <option value="">Документ не выбран</option>
                @foreach($categories as $category)
                    @continue($category->documents->isEmpty())
                    <optgroup data-category="{{ $category->id }}" label="{{ $category->name }}">
                        @foreach($category->documents as $parent)
                            <option
                                value="{{ $parent->id }}"
                                @selected($document->exists ? $document->parent_id === $parent->id : $parent_id === $parent->id )
                            >
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="p-4 bg-white">
            <x-form.input
                name="title"
                label="Название"
                value="{!! old('title', $document->title) !!}"
                block="flex-1"
                required
            />
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
    </form>
@endsection
