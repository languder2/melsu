@extends("layouts.admin")

@section('title', 'Админ панель: Документы')

@section('top-menu')
    @include('documents.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')

        {{__('documents.Documents')}}

        @slot('link')
            {{ route('documents:admin:form') }}
        @endslot
    @endcomponent
@endsection

@section('content')

    <div class="flex flex-col gap-4">
        @component('documents.admin.category',[
            'documents'     => $documents,
            'name'          => 'Без категории',
            'field'         => $field,
            'category'      => null,
            'direction'     => $direction,
        ])@endcomponent

        @foreach($list as $category)
            @component('documents.admin.category',[
                'documents'     => $category->documents()->orderBy($field,$direction)->get(),
                'name'          => $category->name,
                'field'         => $field,
                'category'      => $category,
                'direction'     => $direction,
            ])@endcomponent

            @foreach($category->subs as $sub)
                    @component('documents.admin.category',[
                        'documents'     => $sub->$documents()->orderBy($field,$direction)->get(),
                        'name'          => "{$category->name}: {$sub->name}",
                        'field'         => $field,
                        'category'      => $sub,
                        'direction'     => $direction,
                    ])@endcomponent
            @endforeach


        @endforeach
    </div>
@endsection
