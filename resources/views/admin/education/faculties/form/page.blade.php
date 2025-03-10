@extends("layouts.admin")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    @component('components.html.admin.content-header')
        @if($current)
            Изменение факультета: {{$current->name}}
        @else
            Добавление факультета
        @endif
    @endcomponent
@endsection


@section('content')

    <x-head.tinymce-config/>
    <form
        action="{{route('admin:faculty:save')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">
            <div>
                @include('admin.education.faculties.form.menu')

                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('admin.education.faculties.form.section-base')
                @include('admin.education.faculties.form.section-contacts')
                @include('admin.education.faculties.form.section-staffs')
                @include('admin.education.faculties.form.section-documents')
                @include('admin.education.faculties.form.section-contents')

            </div>

        </div>

    </form>
@endsection



