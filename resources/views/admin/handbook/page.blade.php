@extends('layouts.admin')

@section('title', 'ФГБОУ ВО "МелГУ"')
@section('content')
    <div class="bg-white rounded-md p-4 flex">
        <h2 class="flex-1 text-2xl font-semibold">
            Справочник: {{$pageName}}
        </h2>
        <div>
            <a href="{{ route('handbook.create', ['collectionId' => $collectionId]) }}" class="
                py-2 px-4
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
            ">
                <i class="fas fa-plus w-4 py-2"></i>
            </a>
        </div>
    </div>
    @foreach ($handbook as $category => $items)
        <h2 class="font-semibold mb-3">Категория: {{$category}}</h2>
    <div class="bg-white rounded-md p-4 mb-4">
        <div class="grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[repeat(7,minmax(0,1fr))_200px]">
            <div class="font-semibold">
                ID
            </div>
            <div class="font-semibold col-span-2">
                Категория
            </div>
            <div class="font-semibold col-span-2">
                Наименование
            </div>
            <div class="font-semibold">Иконка</div>
            <div class="font-semibold">Цвет</div>
            <div></div>


                @foreach($items as $item)
                <div>{{ $item->id }}</div>
                <div class="col-span-2">{{ $item->category }}</div>
                <div class="col-span-2">{{ $item->title }}</div>
                <div class=""><img class="max-w-[20px]" src="{{ Storage::url($item->icon) }}" alt=""></div>
                <div class="">{{ $item->color }}</div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a href="{{ route('handbook.delete', ['collectionId' => $collectionId, 'id' => $item->id]) }}" class="
                                    py-2 px-4 rounded-md
                                    bg-red-950
                                    hover:bg-red-700
                                    active:bg-gray-700
                                ">
                            <i class="fas fa-trash w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a href="{{ route('handbook.edit', ['collectionId' => $collectionId, 'id' => $item->id]) }}" class="
                                    py-2 px-4 rounded-md
                                    bg-green-950
                                    hover:bg-green-700
                                    active:bg-gray-700
                                ">
                            <i class="far fa-edit w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    @endforeach
@endsection
