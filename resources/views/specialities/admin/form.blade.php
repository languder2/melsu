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
        action="{{ $current->save }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">

            <div >
                <div class="sticky top-2">
                    @include('specialities.admin.form.menu')

                    <div class="flex flex-row-reverse justify-between">
                        @component('components.form.submit',[
                            'name'          => 'save',
                            'class'         => "uppercase",
                            'value'         => "сохранить",
                        ])@endcomponent

                        @component('components.form.submit',[
                            'name'          => 'close-save',
                            'class'         => "uppercase",
                            'value'         => "сохранить и закрыть",
                        ])@endcomponent

                    </div>
                </div>
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @include('specialities.admin.form.speciality')
                @include('specialities.admin.form.profiles')
                @component('components.form.sections.contacts',compact('current')) @endcomponent
{{--                @component('components.form.sections.staffs',compact('current')) @endcomponent--}}
                @component('documents.admin.includes.section-speciality',[
                    'list'  => old('_token') ? old('documents') : $current->documents
                ])
                    tab_documents
                @endcomponent
                @component('components.form.sections.contents',compact('current')) @endcomponent
                @component('admin.faq.section',compact('current')) @endcomponent
                @component('admin.career.section',compact('current')) @endcomponent

            </div>

        </div>

    </form>
@endsection
