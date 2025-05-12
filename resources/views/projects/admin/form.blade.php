@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
    @include('documents.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        @if($document->exists)
            Редактирование документа: {{$document->title}}
        @else
            Добавить документ
        @endif
    @endcomponent
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
                @include('divisions.admin.form.menu')

                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

{{--                @include('divisions.admin.form.section-base')--}}
{{--                @component('components.form.sections.contacts',compact('current')) @endcomponent--}}
{{--                @component('components.form.sections.staffs',compact('current')) @endcomponent--}}
{{--                @component('components.form.sections.documents',compact('current')) @endcomponent--}}
{{--                @component('components.form.sections.contents',compact('current')) @endcomponent--}}
{{--                @component('news.admin.includes.section',        compact('current'))--}}
{{--                    tab_news--}}
{{--                @endcomponent--}}

            </div>

        </div>

    </form>

@endsection
