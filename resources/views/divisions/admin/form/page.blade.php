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
            <a
                href="{{ $current->link }}"
                target="_blank"
                class="underline hover:text-blue"
            >
                {{$current->name}}
            </a>
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
                <div class="sticky top-2">
                    @include('divisions.admin.form.menu', ['type' => $current->type])

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

                @include('divisions.admin.form.section-base')
                @component('components.form.sections.contacts',compact('current')) @endcomponent
                @component('components.form.sections.staffs',compact('current')) @endcomponent
                @component('components.form.sections.documents',compact('current')) @endcomponent
                @component('components.form.sections.contents',compact('current')) @endcomponent
                @component('components.form.upbringing.tab_upbringing',compact('current')) @endcomponent
                @component('components.form.partner.tab_partner',compact('current')) @endcomponent
                @component('news.admin.includes.section',        compact('current'))
                    tab_news
                @endcomponent

            </div>

        </div>

    </form>
@endsection
