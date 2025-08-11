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
                Документы
            </div>
        </div>

        @slot('alterLink')
            <a
                href="{{ $division->document_category_add }}"
                class="
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
                flex h-8 items-center justify-center gap-3 px-4
            "
            >
                Добавить категорию
            </a>
        @endslot
    @endcomponent
@endsection

@section('content')

{{--    <div class="bg-white rounded-md p-4 mb-4">--}}
{{--        <div--}}
{{--            class="--}}
{{--                grid gap-4 items-center--}}
{{--                grid-cols-1--}}
{{--                md:grid-cols-[auto_auto_auto_1fr_2fr_auto]--}}
{{--            "--}}
{{--        >--}}
{{--            <div class="font-semibold">--}}
{{--                StaffID--}}
{{--            </div>--}}

{{--            <div class="font-semibold">--}}
{{--                Тип--}}
{{--            </div>--}}

{{--            <div class="font-semibold">--}}
{{--                Порядок вывода--}}
{{--            </div>--}}

{{--            <div class="font-semibold">--}}
{{--                Должность--}}
{{--            </div>--}}

{{--            <div class="font-semibold">--}}
{{--                ФИО--}}
{{--            </div>--}}

{{--            <div>--}}
{{--            </div>--}}

{{--            --}}{{----}}

{{--            <div class="text-center">--}}
{{--                {{ $division->chief->card->id }}--}}
{{--            </div>--}}

{{--            <div class="text-center">--}}
{{--                руководитель--}}
{{--            </div>--}}

{{--            <div class="text-center">--}}

{{--            </div>--}}

{{--            <div>--}}
{{--                <a--}}
{{--                    href="{{ $division->chief->edit }}"--}}
{{--                    class="underline hover:text-blue-700"--}}
{{--                >--}}
{{--                    {{ $division->chief->post ?? __('staffs.chief') }}--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <a--}}
{{--                    href="{{ $division->chief->edit }}"--}}
{{--                    class="underline hover:text-blue-700"--}}
{{--                >--}}
{{--                    {{ $division->chief->card->exists ? $division->chief->card->full_name : __('staffs.empty') }}--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                @if($division->chief->exists)--}}
{{--                    <div class="flex-none w-14 text-white">--}}
{{--                        <a--}}
{{--                            href="{{ $division->chief->delete }}"--}}
{{--                            class="--}}
{{--                                py-2 px-4 rounded-md--}}
{{--                                bg-red-950--}}
{{--                                hover:bg-red-700--}}
{{--                                active:bg-gray-700--}}
{{--                            "--}}
{{--                        >--}}
{{--                            <i class="fas fa-trash w-4 h-4"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <hr class="md:col-span-6 last:hidden opacity-70">--}}

{{--            @forelse($division->staffs as $staff)--}}
{{--                <div class="text-center">--}}
{{--                    {{ $staff->card->id }}--}}
{{--                </div>--}}

{{--                <div class="text-center">--}}
{{--                    сотрудник--}}
{{--                </div>--}}

{{--                <div class="text-center">--}}
{{--                    {{ $staff->order }}--}}
{{--                </div>--}}


{{--                <div>--}}
{{--                    <a--}}
{{--                        href="{{ $staff->edit }}"--}}
{{--                        class="underline hover:text-blue-700"--}}
{{--                    >--}}
{{--                        {{ $staff->post }}--}}
{{--                        <br>--}}
{{--                        full: {{ $staff->post_alt }}--}}

{{--                    </a>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <a--}}
{{--                        href="{{ $staff->edit }}"--}}
{{--                        class="underline hover:text-blue-700"--}}
{{--                    >--}}
{{--                        {{ $staff->card->full_name }}--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <div class="flex-none w-14 text-white">--}}
{{--                        <a--}}
{{--                            href="{{ $staff->delete }}"--}}
{{--                            class="--}}
{{--                                py-2 px-4 rounded-md--}}
{{--                                bg-red-950--}}
{{--                                hover:bg-red-700--}}
{{--                                active:bg-gray-700--}}
{{--                            "--}}
{{--                        >--}}
{{--                            <i class="fas fa-trash w-4 h-4"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr class="md:col-span-6 last:hidden opacity-70">--}}
{{--            @empty--}}
{{--                <div class="col-span-6 text-center">--}}
{{--                    Нет сотрудников--}}
{{--                </div>--}}
{{--            @endforelse--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
