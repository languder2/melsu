@extends("layouts.admin")

@section('title', 'Админ панель: Бессмертный и Научный полки')

@section('top-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        <a
            href="{{route('regiment:admin:list')}}"
        >
            Minors:
        </a>
        {{__('regiment.Immortal and Scientific Regiment')}}

        @slot('link')
            {{ route('regiment:admin:form') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="grid gap-4 grid-cols-[auto_auto_auto_1fr_1fr_auto] items-center p-4 bg-white shadow">
        @foreach($list as $item)
            <div @class([$item->is_show ? 'text-green-700' : 'text-red-700'])>
                {!! $item->id !!}
            </div>
            <div @class([$item->is_show ? 'text-green-700' : 'text-red-700'])>
                {!! $item->letter !!}
                {!! $item->image->id ?? null !!}
            </div>
            <div>
                <img src="{{ $item->image->preview }}" alt="" class="h-12"/>
            </div>
            <div>
                <a href="{{ route('regiment:admin:form',$item) }}" class="underline hover:text-blue">
                    {!! $item->FullName !!}
                </a>
            </div>
            <div>
                {!! $item->type->getFullName() !!}
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
                            {!! $item->FullName !!}
                        </div>
                        <hr>
                        <div class="text-right p-4">
                            <a
                                href="{{ route('regiment:delete',$item) }}"
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
                <hr class="col-span-6">
            @endif

        @endforeach
    </div>
@endsection

