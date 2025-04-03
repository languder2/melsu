@extends("layouts.admin")

@section('top-menu')
    @include('admin.users.menu')
@endsection

@if($user->id)
    @section('title')
        Админ панель: Редактирование пользователя:
        {{$user->email}}
        ({{$user->full_name}})
    @endsection
    @section('content-header')
        <x-html.admin.content-header>
            Редактирование пользователя: {{$user->email}} ({{$user->full_name}})
        </x-html.admin.content-header>
    @endsection
@else
    @section('title')
        Админ панель: Создание пользователя
    @endsection
    @section('content-header')
        <x-html.admin.content-header>
            Создание пользователя
        </x-html.admin.content-header>
    @endsection

@endif

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{route('admin:users:save')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$user->id ?? null}}">

        <div class="grid grid-cols-[1fr_minmax(400px,1000px)_400px] mx-auto gap-4">
            <div></div>
            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('admin.users.form.base')
            </div>

            <div>
                <div class="sticky top-2">
                    @include('admin.users.form.menu')

                    <x-form.submit
                        class="uppercase"
                        value="сохранить"
                    />
                </div>
            </div>

        </div>

    </form>
@endsection
