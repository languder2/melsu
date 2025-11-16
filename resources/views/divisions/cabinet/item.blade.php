@props([
    'has_menu' => false
])
@php
    $class = $has_menu
    ? 'grid grid-cols-[auto_1fr_repeat(2,auto)] gap-3 mb-3 font-semibold'
    : 'grid grid-cols-subgrid col-span-full gap-3'
@endphp

<div
    class="{{ $class }}"
>

    <div class=" flex items-center justify-center p-3 rounded-sm shadow bg-white">
        {!! $division->id !!}
    </div>

    <div class="flex gap-3 items-center bg-white p-3 rounded-sm shadow">
        @if(!$has_menu)
            @for($i=1; $i <= $division->level; $i++)
                <span class="px-1"></span>
            @endfor

            @if($division->level)
                <x-lucide-corner-down-right class="w-4" />
            @endif
        @endif

        {!! $division->name !!}
    </div>
    <div class="flex gap-5 items-center justify-center flex-wrap w-16 2xl:w-auto bg-white p-3 rounded-sm shadow ">
        <a href="{{ $division->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>

        <a href="{{ $division->cabinet_form }}" class="hover:text-amber-500" title="Редактировать">
            <x-lucide-square-pen class="w-6" />
        </a>
    </div>

    <div class="flex gap-5 items-center justify-center flex-wrap w-46 2xl:w-auto bg-white p-3 rounded-sm shadow ">

        <a href="{{ $division->documentsCabinetList() }}" class="flex-end hover:text-green-700" title="{{ __('common.Documents') }}">
            <x-lucide-file class="w-6"/>
        </a>

        {{--        <form action="{{ route('news.cabinet.set-filter') }}" method="post">--}}
        {{--            @csrf--}}
        {{--            <input type="hidden" name="division" value="{{ $division->id }}">--}}
        {{--            <label class="flex gap-3">--}}
        {{--                <x-lucide-notepad-text class="w-6 hover:text-amber-500 cursor-pointer"/>--}}
        {{--                <input type="submit" class="hidden">--}}
        {{--            </label>--}}
        {{--        </form>--}}

        <a href="{{ $division->goals_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Goals') }}">
            <x-lucide-goal class="w-6"/>
        </a>

        <a href="{{ $division->partnersCabinetList() }}" class="flex-end hover:text-green-700" title="{{ __('common.Partners') }}">
            <x-lucide-handshake class="w-6"/>
        </a>

        <a href="{{ $division->careers_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Careers') }}">
            <x-lucide-id-card-lanyard class="w-6"/>
        </a>

        <a href="{{ $division->graduations_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Graduations') }}">
            <x-lucide-graduation-cap class="w-6"/>
        </a>

        <a href="{{ $division->history_form }}" class="flex-end hover:text-green-700" title="{{ __('common.History') }}">
            <x-lucide-file-clock class="w-6"/>
        </a>
        <a href="{{ $division->science_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Science') }}">
            <x-lucide-microscope class="w-6"/>
        </a>
    </div>

</div>
