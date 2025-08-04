@extends("layouts.admin")

@section('title', 'Админ панель: Структура университета')

@section('content-header')
    @component('admin.components.content-header')
        {{ $division->name }}

        @slot('link')
            {{ $division->staff_add }}
        @endslot
    @endcomponent
@endsection

@section('content')


    <div class="bg-white rounded-md p-4 mb-4">
        <div
            class="
                grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[auto_1fr_2fr_auto]
            "
        >
            <div class="font-semibold">
                StaffID
            </div>

            <div class="font-semibold">
                Должность
            </div>

            <div class="font-semibold">
                ФИО
            </div>

            <div>
            </div>

            {{----}}

            <div class="text-center">
                {{ $division->chief->card->id }}
            </div>

            <div class="font-semibold">
                <a
                    href="{{ $division->chief->edit }}"
                    class="underline hover:text-blue-700"
                >
                    {{ $division->chief->post ?? __('staffs.chief') }}
                </a>
            </div>

            <div class="font-semibold">
                <a
                    href="{{ $division->chief->edit }}"
                    class="underline hover:text-blue-700"
                >
                    {{ $division->chief->card->exists ? $division->chief->card->full_name : __('staffs.empty') }}
                </a>
            </div>

            <div>
                @if($division->chief->exists)
                    <div class="flex-none w-14 text-white">
                        <a
                            href="{{ $division->chief->delete }}"
                            class="
                                py-2 px-4 rounded-md
                                bg-red-950
                                hover:bg-red-700
                                active:bg-gray-700
                            "
                        >
                            <i class="fas fa-trash w-4 h-4"></i>
                        </a>
                    </div>
                @endif
            </div>
            <hr class="md:col-span-4 last:hidden opacity-70">
            @forelse($division->staffs as $staff)
                <div class="text-center">
                    {{ $staff->card->id }}
                </div>

                <div class="font-semibold">
                    <a
                        href="{{ $staff->edit }}"
                        class="underline hover:text-blue-700"
                    >
                        {{ $staff->post ?? __('staffs.chief') }}
                    </a>
                </div>

                <div class="font-semibold">
                    <a
                        href="{{ $staff->edit }}"
                        class="underline hover:text-blue-700"
                    >
                        {{ $staff->card->full_name }}
                    </a>
                </div>

                <div>
                    <div class="flex-none w-14 text-white">
                        <a
                            href="{{ $staff->delete }}"
                            class="
                                py-2 px-4 rounded-md
                                bg-red-950
                                hover:bg-red-700
                                active:bg-gray-700
                            "
                        >
                            <i class="fas fa-trash w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                <hr class="md:col-span-4 last:hidden opacity-70">
            @empty
                <div class="col-span-4 text-center">
                    Нет сотрудников
                </div>
            @endforelse
        </div>
    </div>

@endsection
