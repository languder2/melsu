@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('top-menu')
    @include('divisions.admin.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        Подразделения

        @slot('link')
            {{ route('admin:division:add') }}
        @endslot
    @endcomponent
@endsection

@section('content')

    @foreach($list as $record)
        @php session()->put('rowCount',0) @endphp
        <h3 class="mt-8 first:mt-0 mb-3 font-semibold text-lg">
            {{$record->name}}
        </h3>
        <div class="bg-white rounded-md p-4 mb-4">
            <div
                class="
                grid items-center
                grid-cols-1
                md:grid-cols-[auto_3fr_auto]
            "
            >
                <div class="font-semibold p-4">
                    ID
                </div>

                <div class="font-semibold p-4">
                    Отдел
                </div>

                <div class="p-4"></div>

                @include('divisions.admin.item',['record'=>$record, "depth" => isset($depth)?$depth+1:0])

            </div>
        </div>
    @endforeach

@endsection
<div class="bg-neutral-200"></div>
