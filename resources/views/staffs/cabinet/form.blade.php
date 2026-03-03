@props([
    'division'  => new \App\Models\Division\Division(),
    'current'   => new \App\Models\Staff\Post(),
])
@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". ($current->exists ? $current->name : __("common.Add partner"))
)

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $division, 'has_menu' => true])@endcomponent

    @include('staffs.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')

    <form action="{{ route('division.posts.cabinet.save', [$division,$current]) }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center"></div>

            <div class="flex items-center gap-3">
                <input
                    type="submit"
                    name="save"
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

            <div class="flex gap-3">

                <x-form.checkbox.block
                    name="is_head_of_division"
                    :default="0"
                    :value="1"
                    label="Является руководителем"
                    :checked=" old('is_head_of_division', $current->exists ? $current->is_head_of_division : true)"
                    block="pe-2"
                />

                <x-form.checkbox.block
                    name="is_teacher"
                    :default="0"
                    :value="1"
                    label="Преподает"
                    :checked=" old('is_teacher', $current->exists ? $current->is_teacher : true)"
                    block="pe-2"
                />

                <div class="flex-1"></div>

                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $current->exists ? $current->is_show : true)"
                    block="pe-2"
                />

                @if(auth()->user()->isEditor())
                    <x-form.checkbox.block
                        id="is_approved"
                        name="is_approved"
                        :default="0"
                        :value="1"
                        label="Утвердить"
                        :checked=" old('is_approved', $current->exists ? $current->is_approved : true)"
                        block="pe-2"
                    />
                @else
                    <input type="hidden" name="has_approval" value="0">
                @endif
            </div>
        </div>

        <div class="flex flex-col gap-2 p-4 bg-white">
            <p>Категория</p>
            <select
                class="jq-select2"
                name="staff_id"
                required
            >
                <option value="">Категория не выбрана</option>
                @foreach($staffs as $staff)
                    <option
                        value="{{ $staff->id }}"

                        @selected($current->staff_id === $staff->id)
                    >
                        {{ $staff->id }} | {{ $staff->fullname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="p-4 bg-white">
            <x-form.input
                name="post"
                label="Должность"
                value="{!! old('post', $current->post) !!}"
                block="flex-1"
                required
            />
        </div>

        <div class="p-4 bg-white">
            <x-form.input
                name="full_post"
                label="Должность, с указанием подразделения"
                value="{!! old('full_post', $current->full_post) !!}"
                block="flex-1"
            />
        </div>

        <div class="p-4 bg-white">
            <x-form.input
                name="uuid"
                label="UUID"
                value="{!! old('uuid', $current->uuid) !!}"
                block="flex-1"
            />
        </div>
    </form>
@endsection
