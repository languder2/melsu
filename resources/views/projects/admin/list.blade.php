@extends("layouts.admin")

@section('title', 'Админ панель: '.__('projects.Projects'))

@section('top-menu')
    @include('projects.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')

        {{__('projects.Projects')}}

        @slot('link')
            {{ route('projects.form') }}
        @endslot
    @endcomponent
@endsection

@section('content')

{{--    <div class="flex flex-col gap-4">--}}
{{--        @component('documents.admin.category',[--}}
{{--            'documents'     => $documents,--}}
{{--            'name'          => 'Без категории',--}}
{{--            'field'         => $field,--}}
{{--            'category'      => null,--}}
{{--            'direction'     => $direction,--}}
{{--        ])@endcomponent--}}

{{--        @foreach($list as $category)--}}
{{--            --}}{{--        @continue($category->customDocuments->isEmpty())--}}

{{--            @component('documents.admin.category',[--}}
{{--                'documents'     => $category->customDocuments()->orderBy($field,$direction)->get(),--}}
{{--                'name'          => $category->name,--}}
{{--                'field'         => $field,--}}
{{--                'category'      => $category,--}}
{{--                'direction'     => $direction,--}}
{{--            ])@endcomponent--}}

{{--        @endforeach--}}
{{--    </div>--}}
@endsection
