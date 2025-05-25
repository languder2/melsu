@extends('layouts.admin')

@section('title', 'ФГБОУ ВО "МелГУ"')
@section('content')
    <div class="bg-white rounded-md p-4 mb-4 flex">
        <h2 class="flex-1 text-2xl font-semibold">
            Секции истории
        </h2>
        <div>
            <a href="{{ route('history.create')}}" class="
                py-2 px-4
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
            ">
                <i class="fas fa-plus w-4 py-2"></i>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
    @foreach ($histories as $history)
            <div class="border rounded-xl p-2 pb-4 flex flex-col gap-3 border-white bg-white relative">
                <h2 class="font-xl font-bold">Год: {{$history->year}}</h2>
                <span class="absolute right-2 top-2 bg-[#820000] text-white p-1 rounded-xl">Order: {{$history->order}}</span>
                <img src="{{ Storage::url($history->image)}}" alt="" class="rounded-xl h-full object-cover">
                <div class="flex flex-row-reverse text-white w-full justify-center mt-3">
                    <div class="flex-none w-14">
                        <a href="{{ route('history.delete', $history->id) }}" class="
                                    py-2 px-4 rounded-md
                                    bg-red-950
                                    hover:bg-red-700
                                    active:bg-gray-700
                                ">
                            <i class="fas fa-trash w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a href="{{ route('history.edit', $history->id) }}" class="
                                    py-2 px-4 rounded-md
                                    bg-green-950
                                    hover:bg-green-700
                                    active:bg-gray-700
                                ">
                            <i class="far fa-edit w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
@endsection
