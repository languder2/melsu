@extends("layouts.admin")

@section('title', 'Админ панель: Филиалы')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-html.admin.content-header>
        Филиалы: Форма
    </x-html.admin.content-header>
@endsection

@section('content')
    <x-head.tinymce-config/>

    <form
        action="{{route('admin:education:branches:save')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">
            <div>

                @include('admin.education.branches.form.menu')

                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />

            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('admin.education.branches.form.section-base')
                @include('admin.education.branches.form.section-staffs')
                @include('admin.education.branches.form.section-documents')
                @include('admin.education.branches.form.section-contents')
            </div>

        </div>

    </form>
@endsection



