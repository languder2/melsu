@extends("layouts.admin")

@section('title')
    Админ панель:
    @if($current)
        Изменение структурного подразделения: {{$current->name}}
    @else
        Добавление структурного подразделения
    @endif
@endsection

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-html.admin.content-header>
        @if($current)
            Изменение структурного подразделения: {{$current->name}}
        @else
            Добавление структурного подразделения
        @endif
    </x-html.admin.content-header>
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{route('admin:division:save')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">
            <div>
                @include('admin.division.division.form.menu')
                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('admin.division.division.form.section-base')
                @include('admin.division.division.form.section-contents')
                @include('admin.division.division.form.section-documents')
                @include('admin.division.division.form.section-staffs')

            </div>

        </div>

    </form>
@endsection
