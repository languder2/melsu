@extends('layouts.admin')

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    <div class="bg-white rounded-md p-4 mb-4 flex">
        <h2 class="flex-1 text-2xl font-semibold">
            Справочники
        </h2>
        <div>
            <a href="{{route('handbook.collections.create')}}" class="
                py-2 px-4
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
            ">
                <i class="fas fa-plus w-4 py-2"></i>
            </a>
        </div>
    </div>
    <div class="bg-white rounded-md p-4 mb-4">
        <div class="grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[repeat(3,minmax(0,1fr))_200px]">
            <div class="font-semibold">
                ID
            </div>
            <div class="font-semibold col-span-2">
                Название
            </div>
            <div></div>
        @foreach($collections as $item)
                <div>{{$item->id}}</div>
                <div class="col-span-2">{{$item->page_name}}</div>

                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a href="{{ route('handbook.collections.delete',$item->id) }}" class="
                                    py-2 px-4 rounded-md
                                    bg-red-950
                                    hover:bg-red-700
                                    active:bg-gray-700
                                ">
                            <i class="fas fa-trash w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a href="{{ route('handbook.collections.edit', $item->id) }}" class="
                                    py-2 px-4 rounded-md
                                    bg-green-950
                                    hover:bg-green-700
                                    active:bg-gray-700
                                ">
                            <i class="far fa-edit w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a href="{{route('handbook.page', ['collectionId' => $item->id])}}" class="
                                    py-2 px-4 rounded-md
                                    bg-blue-950
                                    hover:bg-blue-700
                                    active:bg-gray-700
                                ">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
@endsection

