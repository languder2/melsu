@extends("layouts.admin")

@section('title', __('admin.Admin panel: ').__('projects.Clusters'))

@section('top-menu')
    @include('projects.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')

        {{__('projects.Clusters')}}

        @slot('link')
            {{ route('clusters.form') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="grid grid-cols-[auto_auto_2fr_1fr_auto] gap-4 bg-white p-4">
        <div class="font-semibold">
            ID
        </div>
        <div class="font-semibold">
            Sort
        </div>
        <div class="font-semibold">
            Name
        </div>
        <div class="font-semibold">
            Link
        </div>
        <div class="font-semibold"></div>
        @foreach($list as $item)
            <div @class(["text-center", $item->is_show ? 'text-green-700' : 'text-red-700'])>
                {{ $item->id }}
            </div>
            <div>
                {{ $item->sort }}
            </div>
            <div>
                <a href="{{ $item->edit }}" class="underline hover:text-green-700">
                    {{ $item->name }}
                </a>
            </div>
            <div>
                <a href="{{ $item->link }}" class="underline hover:text-green-700" target="_blank">
                    {{ $item->link }}
                </a>
            </div>

            <div class="flex gap-4">


                <div class="group relative inline-block">
                    <a href="{{ $item->admin_partners }}">
                        <x-lucide-handshake class="w-6" />
                    </a>

                    <div class="opacity-0 w-max bg-gray-700 text-white text-xs rounded py-1 px-2 absolute z-10
                        top-full left-1/2 -translate-x-1/2 mt-3
                        group-hover:opacity-100 group-hover:visible transition-opacity duration-300 pointer-events-none"
                    >
                        Партнеры
                        <div class="absolute w-3 h-3 bg-gray-700 transform rotate-45 -top-1 left-1/2 -translate-x-1/2"></div>
                    </div>
                </div>


                <button
                    popovertarget="link-for-delete-{{$item->id}}"
                    class="
                        rounded-md
                        text-red-700
                        hover:text-red-700
                        active:text-gray-700
                        cursor-pointer
                        outline-0
                    "
                >
                    <x-lucide-trash class="w-6 outline-0"/>
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
                        Удалить кластер?
                    </h3>
                    <hr>
                    <div class="p-4">
                        <a href="{{ $item->link }}" class="underline hover:text-blue" target="_blank">
                            {{ $item->name }}
                        </a>
                    </div>
                    <hr>
                    <div class="text-right px-4 py-3">
                        <a
                            href="{{ $item->delete }}"
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
            <hr class="col-span-5 last:hidden">
        @endforeach
    </div>
@endsection
