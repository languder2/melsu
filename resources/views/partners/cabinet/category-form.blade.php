@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". $instance->name ." → ". __('common.Partners')
    ." → ". ($category->exists ? $category->name : __('common.Add partner category'))

)

@section('content-header')
    @include('partners.cabinet.menu')
@endsection

@section('top-menu')@endsection

@section('content')
    <form action="{{ $category->cabinetSave() }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>
        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $category->exists ? $category->name : __('common.Add partner category') !!}
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

            <x-form.input
                name="name"
                label="Название"
                value="{!! old('name', $category->name) !!}"
                block="flex-1"
            />

            <x-form.input
                name="sort"
                label="Порядок вывода (Убывающий порядок)"
                value="{!! old('sort', $category->sort) !!}"
                block="flex-1"
            />

        </div>
    </form>

@endsection
