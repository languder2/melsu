@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('top-menu')
@endsection

@section('content-header')
    @include('admin.divisions.header')
@endsection

@section('content')

    @foreach($list as $record)
        <h3 class="mt-8 first:mt-0 mb-3 font-semibold text-lg">
            {{$record->name}}
        </h3>
        <div class="bg-white rounded-md p-4 mb-4">
            <div
                class="
                grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[auto_3fr_3fr_auto]
            "
            >
                <div class="font-semibold">
                    ID
                </div>

                <div class="font-semibold">
                    Отдел
                </div>

                <div class="font-semibold">
                    Parent
                </div>

                <div></div>
                @include('admin.divisions.item',['record'=>$record, "depth" => isset($depth)?$depth+1:0])
            </div>
        </div>
    @endforeach

@endsection
<div class="bg-neutral-200"></div>
