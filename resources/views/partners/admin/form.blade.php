@props([
    'title'         => 'Admin panel',
    'entity'        => null,
    'instance'      => null,
    'partner'       => new \App\Models\Partners\Partner(),
])

@extends("layouts.admin")

@section('title', $title)

@section('top-menu')
    @include('projects.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')

        <div class="flex gap-3">
            @if($entity && $instance)
                <a
                    href="{{ $instance->admin }}"
                    class="link"
                >
                    {{ $entity->label() }}
                </a>

                <span>
                    {{ __('common.arrowR') }}
                </span>
            @endif

            @if($instance)
                <a href="{{ $instance->form }}" class="link">
                    {{ $instance->name }}
                </a>

                <a href="{{ $instance->link }}" target="_blank" class="flex-end hover:text-green-700">
                    <x-lucide-square-arrow-out-up-right class="w-6"/>
                </a>

                <span>
                    {{ __('common.arrowR') }}
                </span>
            @endif

            <a href="{{ $instance ? $instance->admin_partners : $partner->admin }}" class="link">
                {{ __('partners.Partners') }}
            </a>
        </div>
    @endcomponent
@endsection

@section('content')
    <form action="{{ $instance ? $instance->save_partner : $partner->save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $partner->exists ? $partner->title : __('news.New news') !!}
            </div>

            <div class="flex items-center gap-3">
                @if( $partner->exists )
                    <a href="{{ $partner->link }}" target="_blank">
                        <x-lucide-external-link class="w-10 hover:text-blue-800" />
                    </a>
                @endif

                <input
                    type="submit"
                    value="Сохранить"
                    class="
                        bg-blue-900
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
                        bg-blue-900
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

        <div class="grid grid-cols-1 bp100:grid-cols-2 gap-y-3 bp100:gap-x-3">
            <div class="flex flex-col gap-3 ">
                <div class="flex gap-3">
                    <div>
                        <img src="{{$partner->image->thumbnail}}" alt="1"
                             class="max-h-60 shadow-md"
                        />
                    </div>
                    <div class="flex-1 bg-white p-3 shadow">

                        <x-form.input
                            id="title"
                            name="title"
                            label="Заголовок"
                            value="{!! old('title', $partner->title) !!}"
                            required
                        />

                        <x-form.file
                            id="form_image"
                            label="Установить / сменить изображение"
                            name="image"
                            block="flex-1"
                        />

                        <x-form.input
                            id="sort"
                            name="sort"
                            label="Прядок вывода (обратный порядок)"
                            type="number"
                            value="{!! old('sort', $partner->sort) !!}"
                            required
                        />

                        <x-form.checkbox.block
                            id="is_show"
                            name="is_show"
                            :default="0"
                            :value="1"
                            label="Опубликовать"
                            :checked=" old('is_show', $partner->exists ? $partner->is_show : true)"
                            block="pe-2"
                        />
                    </div>
                </div>
            </div>
            <div class="col-span-2 bp100:col-span-1">
                <x-editorjs.editor
                    name="content"
                    heading="Описание (модальное окно)"
                    placeholder="Введите описание"
                />
            </div>
        </div>
    </form>

    @dump($partner->form_link)
    @dump( route('partners.form', $partner))
@endsection
