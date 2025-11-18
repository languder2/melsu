@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". $instance->name ." → "
    .($contact->exists ? $contact->name: __("common.Add contact"))
)

@section('content-header')
    @component('divisions.cabinet.item', ['division' => $instance, 'has_menu' => true])@endcomponent
    @include('contacts.cabinet.menu')
@endsection

@section('top-menu')

@endsection

@section('content')
    <form action="{{ $contact->cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap3 bg-white p-3 ps-5 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center font-semibold">
                {!! $contact->exists ? $contact->name : __('common.Add contact') !!}
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

        <div class="flex flex-col gap-3">
            <div class="bg-white p-3 shadow flex gap-3 flex-wrap">
                <x-form.select2
                    name="type"
                    :value="old('type', $contact->type->value ?? null) "
                    null="Тип"
                    :list=" \App\Enums\ContactType::list() "
                    disabled
                    required

                />

                <x-form.input
                    name="title"
                    :label="__('common.title')"
                    value="{!! old('title', $contact->title) !!}"
                    block="w-full "
                />

                <x-form.input
                    name="content"
                    :label="__('common.Value')"
                    value="{!! old('content', $contact->content) !!}"
                    block="w-full"
                    required
                />


                <x-form.checkbox.block
                    id="is_show"
                    name="is_show"
                    :default="0"
                    :value="1"
                    label="Опубликовать"
                    :checked=" old('is_show', $contact->exists ? $contact->is_show : true)"
                    block="pe-2"
                />

            </div>
         </div>
    </form>

@endsection
