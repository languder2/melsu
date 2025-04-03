@extends('layouts.admin')

@section('content')
    <div class="container bg-white p-4 max-w-[1200px]">
        <h2 class="pb-2 font-semibold text-xl uppercase text-center">{{ isset($collection) ? 'Редактировать запись' : 'Создать запись' }}</h2>
        <hr>
        <form id="handbookForm" action="{{ isset($collection) ? route('handbook.update', $collection->id) : route('handbook.collections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($collection))
                @method('PUT')
            @endif

            <div class="block relative mt-2">
                <input type="text" name="page_name" id="page_name" class="
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
            focus:border-blue-700" value="{{ isset($collection) ? $collection->page_name : '' }}" required>
                <label for="page_name" class="
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
            ">{{ isset($collection) ? 'Обновить' : 'Создать' }}</button>
    </div>
@endsection
