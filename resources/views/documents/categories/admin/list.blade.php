@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
    @include('documents.admin-menu')
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
            <div @class(["text-center", $item->is_show ? 'text-green-700' : 'text-red-700'])>
                {!! $item->id !!}
            </div>
            <div class="text-center">
                {!! $item->sort !!}
            </div>
            <div>
                <a href="{{ route('document-categories:admin:form',$item) }}" class="underline hover:text-blue">
                    {!! $item->name !!}
                </a>
            </div>
            <div>
                <div>
                    <button
                        popovertarget="link-for-delete-{{$item->id}}"
                        class="
                        p-1 rounded-md
                        text-red-700
                        hover:text-red-700
                        active:text-gray-700
                        cursor-pointer
                    "
                    >
                        <i class="fas fa-trash w-4 h-4"></i>
                    </button>
                    <div popover=""
                         id="link-for-delete-{{$item->id}}"
                         class="
                        relative inset-y-0 mx-auto my-auto
                        transform overflow-hidden
                        rounded-lg bg-white text-left
                        opacity-0 shadow-xl transition-all [transition-behavior:allow-discrete] duration-300
                        sm:w-full sm:max-w-600 [&:is([open],:popover-open)]:opacity-100
                        [@starting-style]:[&:is([open],:popover-open)]:opacity-0
                    "

                    >
                        <h3 class="p-4 font-semibold">
                            Удалить участника полка?
                        </h3>
                        <hr>
                        <div class="p-4">
                            {!! $item->name !!}
                        </div>
                        <hr>
                        <div class="text-right p-4">
                            <a
                                href="{{ route('document-categories:delete',$item) }}"
                                class="
                                inline-block relative
                                py-2 px-4 text-white rounded-md shadow-md
                                shadow-gray-300
                                bg-red-800 hover:bg-red-700 active:bg-gray-700
                                hover:-mt-px hover:mb-px
                            "
                            >
                                удалить
                            </a>
                        </div>
                    </div>


                </div>
            </div>

            @if($loop->count>1 && !$loop->last)
                <hr class="col-span-4">
            @endif

        @endforeach
    </div>
@endsection

