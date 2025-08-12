@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('top-menu')
    @include('divisions.admin.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex gap-4">
            <a href="{{ $division->link }}" class="underline hover:text-red" target="_blank">
                {{ $division->name }}
            </a>
            <div>
                →
            </div>
            <div>
                <a
                    href="{{ $division->documents_admin_list }}"
                    class="underline"
                >
                    {{ __('documents.Documents') }}
                </a>
            </div>
        </div>

        @slot('alterLink')
            <a
                href="{{ $division->document_category_form }}"
                class="
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
                flex h-8 items-center justify-center gap-3 px-4
            "
            >
                Добавить категорию
            </a>
        @endslot
    @endcomponent
@endsection

@section('content')
    @forelse($division->DocumentCategories as $category)
        @component('divisions.documents.category', compact('category', 'field', 'direction'))@endcomponent
    @empty
        <div class="text-center p-4 bg-white">
            Нет категорий
        </div>
    @endforelse
@endsection
