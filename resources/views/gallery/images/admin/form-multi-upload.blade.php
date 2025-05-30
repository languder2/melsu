@extends("layouts.admin")

@section('title', "Gallery")

@section('top-menu')
    @include('admin.gallery.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex align-middle">
            <div class="flex-1">
                Add Images
            </div>

            <div class="flex flex-col gap-2 flex-auto">
                <p>
                    Код для вставки в контент:
                </p>
                <p>
                    include-gallery:{{ $gallery->code }}
                </p>
            </div>
        </div>
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{ $gallery->AddImages }}"
        method="POST"
        enctype="multipart/form-data"
        class="pb-60"
    >
        @csrf

        <div class="max-w-1000px mx-auto flex gap-4 bg-white p-4">

            <x-form.file
                id="images"
                label="Файлы"
                name="images"
            />

            @component('components.form.submit',[
                'name'          => 'save',
                'class'         => "uppercase",
                'value'         => "сохранить",
                'position'      => 'text-center'
            ])@endcomponent
        </div>

    </form>
@endsection
