@extends('layouts.admin')

@section('content')
    <div class="container bg-white p-4 max-w-[1200px]">
        <h2 class="pb-2 font-semibold text-xl uppercase text-center">{{ isset($history) ? 'Редактировать запись истории' : 'Создать запись истории' }}</h2>
        <hr>
        <form id="historyForm" action="{{ isset($history) ? route('history.update', $history->id) : route('history.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($history))
                @method('PUT')
            @endif

            <div class="block relative mt-2">
                <input type="text" name="year" id="year" class="
            border-b
            border-dashed
            bg-none

            outline-0
            w-full
            py-2
            mt-2

            peer
            autofill:text-pink-800
            focus:text-blue-700
            focus:border-blue-700" value="{{ isset($history) ? $history->year : '' }}" required>
                <label for="title" class="
                absolute
                left-0
                top-0
                text-xs

                duration-200

                peer-focus:text-xs
                peer-focus:top-0
                peer-focus:text-blue-700
                peer-placeholder-shown:top-4
                peer-placeholder-shown:text-base
                peer-autofill:text-xs
                peer-autofill:top-0

            ">
                    Год *
                </label>
            </div>
            <div class="block relative mt-2">
                <input type="number" name="order" id="order" class="
            border-b
            border-dashed
            bg-none

            outline-0
            w-full
            py-2
            mt-2

            peer
            autofill:text-pink-800
            focus:text-blue-700
            focus:border-blue-700" value="{{ isset($history) ? $history->order : '' }}">
                <label for="title" class="
                absolute
                left-0
                top-0
                text-xs

                duration-200

                peer-focus:text-xs
                peer-focus:top-0
                peer-focus:text-blue-700
                peer-placeholder-shown:top-4
                peer-placeholder-shown:text-base
                peer-autofill:text-xs
                peer-autofill:top-0

            ">
                    Порядок вывода
                </label>
            </div>
            <div class="block relative mt-2">
                @if (isset($history) && $history->image)
                    <div class="mt-4">
                        <label for="image">Фото загруженное ранее</label>
                        <img src="{{ Storage::url($history->image) }}" id="image" alt="Current Image" class="max-w-xs rounded border">
                    </div>
                @endif
            </div>
            <div class="block relative mt-2">
                <input type="file" name="image" id="image" class="
            border-b
            border-dashed
            bg-none

            outline-0
            w-full
            py-2
            mt-2

            peer
            autofill:text-pink-800
            focus:text-blue-700
            focus:border-blue-700" value="{{ isset($history) ? $history->image : '' }}"  @if (!isset($history) || is_null($history->image)) required @endif>
                <label for="icon" class="
                absolute
                left-0
                top-0
                text-xs

                duration-200

                peer-focus:text-xs
                peer-focus:top-0
                peer-focus:text-blue-700
                peer-placeholder-shown:top-4
                peer-placeholder-shown:text-base
                peer-autofill:text-xs
                peer-autofill:top-0

            ">
                    Фото *
                </label>
            </div>
            <div class="block relative mt-2">
                <label for="description">Описание</label>
                <textarea name="description" id="description" class="editor">{{ old('description', isset($history) ? $history->description : '') }}</textarea>
            </div>
            <div class="block relative mt-2">
                <label for="content">Контент</label>
                <textarea name="content" id="content" class="editor">{{ old('content', isset($history) ? $history->content : '') }}</textarea>
            </div>
        </form>
    </div>
    <div class="flex justify-center mt-6">
        <button form="historyForm" type="submit" class="btn btn-primary
                bg-blue-900
                px-4 py-2
                text-white
                rounded-md
                hover:bg-blue-700
                active:bg-gray-700
                uppercase
            ">{{ isset($history) ? 'Обновить' : 'Создать' }}</button>
    </div>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.editor',
            plugins: 'code table lists image media link',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent bullist numlist | table | link image media | code',
            license_key: 'gpl'
        });
    </script>
@endsection
