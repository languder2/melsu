@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    <x-html.admin.content-header>
        @if($current->id)
            {{$current->spec_code}} {!! $current->name !!}
        @else
            Добавление направления подготовки
        @endif
    </x-html.admin.content-header>
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{route('admin:speciality:save')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">

            <div>
                @include('admin.education.specialities.form.menu')

                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('admin.education.specialities.form.speciality')
                @include('admin.education.specialities.form.profiles')
                @component('components.form.sections.contacts',compact('current')) @endcomponent
{{--                @component('components.form.sections.staffs',compact('current')) @endcomponent--}}
{{--                @component('components.form.sections.documents',compact('current')) @endcomponent--}}
                @component('components.form.sections.contents',compact('current')) @endcomponent

            </div>

        </div>

    </form>


@endsection



