@extends("layouts.admin")

@section('title', __('admin.Admin panel: ').__('projects.Clusters'))

@section('top-menu')
    @include('projects.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        @if($current->exists)
            {{ __('admin.Edit') }}: {{$current->name}}
        @else
            {{ __('admin.Create') }}
        @endif
    @endcomponent
@endsection

@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{ $current->save }}"
        method="POST"
        enctype="multipart/form-data"
        class="pb-60"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">

            <div>
                @foreach($current->form_menu as $item)
                    @component('admin.components.form-menu-item',$item) @endcomponent
                @endforeach

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

            <div>
                <x-form.errors
                    setTheme="1"
                />

                @foreach($current->form_menu as $menuItem)
                    @continue(empty($menuItem['section']))
                    @component($menuItem['section'],compact('current','menuItem')) @endcomponent
                @endforeach
            </div>
        </div>

    </form>
@endsection
