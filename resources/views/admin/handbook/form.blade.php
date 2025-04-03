@extends('layouts.admin')

@section('content')
    <div class="container bg-white p-4 max-w-[1200px]">
        <h2 class="pb-2 font-semibold text-xl uppercase text-center">{{ isset($handbook) ? 'Редактировать запись' : 'Создать запись' }}</h2>
        <hr>
        <form id="handbookForm" action="{{ isset($handbook) ? route('handbook.update', ['collectionId' => $collectionId,'id' => $handbook->id]) : route('handbook.store', ['collectionId' => $collectionId]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($handbook))
                @method('PUT')
            @endif

            <div class="block relative mt-2">
                <input type="text" name="title" id="title" class="
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
            focus:border-blue-700" value="{{ isset($handbook) ? $handbook->title : '' }}" required>
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
                    Наименование                *
                </label>
            </div>
            <div class="block relative mt-2">
                <input type="text" name="link" id="link" class="
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
            focus:border-blue-700" value="{{ isset($handbook) ? $handbook->link : '' }}">
                <label for="link" class="
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
                    Ссылка *
                </label>
            </div>
            <div class="block relative mt-2">
                <input type="file" name="icon" id="icon" class="
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
            focus:border-blue-700" value="{{ isset($handbook) ? $handbook->icon : '' }}">
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
                    Иконка (SVG) *
                </label>
            </div>
            <div class="block relative mt-2">
                <input type="color" name="color" id="color" class="
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
            focus:border-blue-700" value="{{ isset($handbook) ? $handbook->color : '' }}">
                <label for="color" class="
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
                    Цвет иконки и границ
                </label>
            </div>
            <div class="block relative mt-2">
                <input type="text" name="category" id="category" class="
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
            focus:border-blue-700" value="{{ isset($handbook) ? $handbook->category : '' }}" required>
                <label for="category" class="
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
                    Категория *
                </label>
            </div>
        </form>
    </div>
    <div class="flex justify-center mt-6">
        <button form="handbookForm" type="submit" class="btn btn-primary
                bg-blue-900
                px-4 py-2
                text-white
                rounded-md
                hover:bg-blue-700
                active:bg-gray-700
                uppercase
            ">{{ isset($handbook) ? 'Обновить' : 'Создать' }}</button>
    </div>
@endsection
