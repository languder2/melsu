@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('top-menu')
    @include('divisions.admin.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex gap-4">
            <a href="{{ $division->link }}" class="underline hover:text-red" target="_blank">
                {{ $division->name }}
            </a>
            <div>
                →
            </div>
            <div>
                Сотрудники
            </div>
        </div>
        @slot('link')
            {{ $division->staff_add }}
        @endslot
    @endcomponent
@endsection

@section('content')


    <div class="bg-white rounded-md mb-4">
        <div
            class="
                grid
                grid-cols-1
                md:grid-cols-[auto_auto_auto_auto_auto_1fr_2fr_auto]
            "
        >
            <div class="font-semibold p-3 ps-6 bg-blue text-white sticky top-0">
                ✓
            </div>

            <div class="font-semibold p-3 bg-blue text-white sticky top-0">
                StaffID
            </div>

            <div class="font-semibold p-3 bg-blue text-white sticky top-0">
                Тип
            </div>

            <div class="font-semibold p-3 bg-blue text-white sticky top-0">
                Порядок вывода
            </div>

            <div class="font-semibold p-3 bg-blue text-white sticky top-0">
                Вес должности
            </div>

            <div class="font-semibold p-3 bg-blue text-white sticky top-0">
                ФИО
            </div>

            <div class="font-semibold p-3 bg-blue text-white sticky top-0">
                Должность
            </div>

            <div class="p-3 bg-blue text-white sticky top-0">
            </div>

            {{----}}

            <div class="p-3 ps-6 bg-sky-100/30 flex items-center justify-center">
                @if($division->chief->show) ✓ @else &nbsp; @endif
            </div>

            <div class="text-center p-3 bg-sky-100/30">
                {{ $division->chief->card->id }}
            </div>

            <div class="text-center p-3 bg-sky-100/30">
                руководитель
            </div>

            <div class="text-center col-span-2 p-3 bg-sky-100/30">
                &nbsp;
            </div>

            <div class="p-3 bg-sky-100/30 items-center">
                <a
                    href="{{ $division->chief->edit }}"
                    class="underline hover:text-blue-700"
                >
                    {{ $division->chief->card->exists ? $division->chief->card->full_name : __('staffs.empty') }}
                </a>
            </div>

            <div class="p-3 bg-sky-100/30">
                <a
                    href="{{ $division->chief->edit }}"
                    class="underline hover:text-blue-700"
                >
                    {{ $division->chief->post ?? __('staffs.chief') }}
                </a>
            </div>

            <div class="p-3 px-4 bg-sky-100/30">
                @if($division->chief->exists)
                    <button
                        popovertarget="link-for-delete-{{$division->chief->id}}"
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
                         id="link-for-delete-{{$division->chief->id}}"
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
                            Удалить сотрудника?
                        </h3>
                        <hr>
                        <div class="p-4">
                            {{ $division->chief->card->full_name }}
                            ({!! $division->chief->post !!})
                        </div>
                        <hr>
                        <div class="text-right px-4 py-2">

                            <form method="POST" action="{{ $division->chief->delete }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="удалить"
                                       class="
                                            cursor-pointer
                                            inline-block relative
                                            py-2 px-4 text-white rounded-md shadow-md
                                            shadow-gray-300
                                            bg-red-800 hover:bg-red-700 active:bg-gray-700
                                            hover:-mt-px hover:mb-px
                                       "
                                >
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            @forelse($division->allStaff as $staff)
                <div class="p-3 ps-6 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }}  flex items-center justify-center">
                    @if($staff->show) ✓ @else &nbsp; @endif
                </div>

                <div class="p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex items-center justify-center">
                    {{ $staff->card->id }}
                </div>

                <div class="text-center p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex items-center">
                    сотрудник
                </div>

                <div class="p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex items-center justify-center">
                    {{ $staff->order }}
                </div>

                <div class="p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex items-center justify-center">
                    @if($staff->post_show)
                        {{ $staff->post_weight }}
                    @endif
                </div>

                <div class="p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex items-center">
                    <a
                        href="{{ $staff->edit }}"
                        class="underline hover:text-blue-700"
                    >
                        {{ $staff->card->full_name }}
                    </a>
                </div>

                <div class="p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex flex-col gap-2">
                    <p class="text-start">
                        {{ $staff->post }}
                    </p>
                    <p class="text-start">
                        full: {{ $staff->post_alt }}
                    </p>

                </div>

                <div class="p-3 px-4 {{ $loop->index % 2 ? 'bg-sky-100/30' : '' }} flex justify-end">
                    <button
                        popovertarget="link-for-delete-{{$staff->id}}"
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
                         id="link-for-delete-{{$staff->id}}"
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
                            Удалить сотрудника?
                        </h3>
                        <hr>
                        <div class="p-4">
                            {{ $staff->card->full_name }}
                            ({!! $staff->post !!})
                        </div>
                        <hr>
                        <div class="text-right px-4 py-2">

                            <form method="POST" action="{{ $staff->delete }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="удалить"
                                       class="
                                            cursor-pointer
                                            inline-block relative
                                            py-2 px-4 text-white rounded-md shadow-md
                                            shadow-gray-300
                                            bg-red-800 hover:bg-red-700 active:bg-gray-700
                                            hover:-mt-px hover:mb-px
                                       "
                                >
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-3 col-span-8 text-center">
                    Нет сотрудников
                </div>
            @endforelse
        </div>
    </div>

@endsection
