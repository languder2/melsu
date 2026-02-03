@extends("layouts.admin")

@section('title')
    Админ панель:
    @if($current)
        Изменение структурного подразделения: {{$current->name}}
    @else
        Добавление структурного подразделения
    @endif
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
                @include('admin.divisions.form.menu')

                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('admin.divisions.form.section-base')
                @component('components.form.sections.contacts',compact('current')) @endcomponent
                @component('components.form.sections.staffs',compact('current')) @endcomponent
                @component('components.form.sections.documents',compact('current')) @endcomponent
                @component('components.form.sections.contents',compact('current')) @endcomponent
{{--                @component('news.admin.include-section',        compact('current'))--}}
{{--                    tab_news--}}
{{--                @endcomponent--}}

            </div>

        </div>

    </form>
@endsection
