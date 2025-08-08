@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
    @include('documents.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        {{__('documents.Documents categories')}}

        @slot('link')
            {{ route('document-categories:admin:form') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="grid gap-4 grid-cols-[auto_auto_1fr_auto] items-center p-4 bg-white shadow">
        <div class="font-semibold">
            <a
                    href="{{ route('document-categories:admin:list',['id', ($field === 'id' && $direction === 'asc' ) ? 'desc' : 'asc']) }}"
                    class="@if($field === 'id') text-green-700 @endif hover:text-red flex gap-2 items-center"
            >
                <span class="underline">
                    ID
                </span>

                @if($field === 'id')
                    @if($direction === 'desc')
                        <i class="fas fa-sort-amount-down"></i>
                    @else
                        <i class="fas fa-sort-amount-down-alt"></i>
                    @endif
                @endif
            </a>
        </div>
        <div class="font-semibold">
            <a
                    href="{{ route('document-categories:admin:list',['sort', ($field === 'sort' && $direction === 'asc' ) ? 'desc' : 'asc']) }}"
                    class="@if($field === 'sort') text-green-700 @endif hover:text-red flex gap-2 items-center"
            >
                <span class="underline">
                    Порядок вывода
                </span>

                @if($field === 'sort')
                    @if($direction === 'desc')
                        <i class="fas fa-sort-amount-down"></i>
                    @else
                        <i class="fas fa-sort-amount-down-alt"></i>
                    @endif
                @endif
            </a>
        </div>
        <div class="font-semibold">
            <a
                    href="{{ route('document-categories:admin:list',['name', ($field === 'name' && $direction === 'asc' ) ? 'desc' : 'asc']) }}"
                    class="@if($field === 'name') text-green-700 @endif hover:text-red flex gap-2 items-center"
            >
                <span class="underline">
                    Название
                </span>

                @if($field === 'name')
                    @if($direction === 'desc')
                        <i class="fas fa-sort-amount-down"></i>
                    @else
                        <i class="fas fa-sort-amount-down-alt"></i>
                    @endif
                @endif
            </a>
        </div>
        <div class="font-semibold">
            Del
        </div>
        @foreach($categories as $item)
            @include('documents.categories.admin.item', ['item' => $item, 'level' => 0])
        @endforeach
    </div>
@endsection

