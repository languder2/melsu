@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('events.menu')
@endsection

@section('content-header')
    @component("components.html.admin.content-header",[
        'link'  => route('admin:events:add')
    ])
        Мероприятия
    @endcomponent
@endsection

@section('content')

    <div class="grid grid-cols-[auto_auto_auto_1fr_1fr_auto] gap-4 p-4 bg-white items-center">
        <div class="font-semibold">
            ID
        </div>
        <div class="font-semibold">
            Preview
        </div>
        <div class="font-semibold">
            Published AT
        </div>
        <div class="font-semibold">
            Title (Click for Edit)
        </div>
        <div class="font-semibold">
            Link
        </div>
        <div class="font-semibold">
        </div>
        @foreach($list as $item)
            <div>
                {{ $item->id }}
            </div>
            <div>
                @if($item->preview)
                    <img
                        src="{!! $item->preview->thumbnail !!}"
                        alt=""
                        class="max-h-16"
                    />
                @endif
            </div>
            <div>
                {{ $item->published_at }}
            </div>
            <div>
                <a href="{{ route('admin:events:edit',$item) }}"
                   target="_blank"
                   class="text-blue-900 hover:text-blue-700 hover:underline"
                >
                    {{ $item->title }}
                </a>
            </div>
            <div>
                <a href="{{ $item->link }}"
                   target="_blank"
                   class="text-blue-900 hover:text-blue-700 hover:underline"
                >
                    {{ $item->link }}
                </a>
            </div>
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
                        Удалить событие?
                    </h3>
                    <hr>
                    <div class="p-4">
                        {!! $item->published_at !!}
                        {!! $item->title !!}
                    </div>
                    <hr>
                    <div class="text-right p-4">
                        <a
                            href="{{ route('admin:events:delete',$item) }}"
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
        @endforeach
    </div>
@endsection



