@php
    /** * @var object $division */
    $classes = match(true){
//            !$division->has_approval    => 'border-red-700 bg-white',
            !$division->show        => 'bg-amber-600 text-white',
            default                 => 'bg-white'
        };
@endphp

<div
    class="grid grid-cols-subgrid col-span-full gap-3"
>

    <div class=" flex items-center justify-center p-3 rounded-sm shadow {{ $classes }}">
        {!! $division->id !!}
    </div>

    <div class="flex gap-3 items-center bg-white p-3 rounded-sm shadow">

        @for($i=1; $i <= $division->level; $i++)
            <span class="px-1"></span>
        @endfor

        @if($division->level)
            <x-lucide-corner-down-right class="w-4" />
        @endif

        {!! $division->name !!}
    </div>

    <div class="flex gap-5 items-center justify-center flex-wrap w-46 2xl:w-auto bg-white p-3 rounded-sm shadow ">
        <a href="{{ $division->link }}" target="_blank" class="flex-end hover:text-green-700">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>

        <a href="{{ $division->cabinet_form }}" class="hover:text-amber-500">
            <x-lucide-square-pen class="w-6" />
        </a>

{{--        <form action="{{ route('news.cabinet.set-filter') }}" method="post">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="division" value="{{ $division->id }}">--}}
{{--            <label class="flex gap-3">--}}
{{--                <x-lucide-notepad-text class="w-6 hover:text-amber-500 cursor-pointer"/>--}}
{{--                <input type="submit" class="hidden">--}}
{{--            </label>--}}
{{--        </form>--}}

        <a href="{{ $division->goals_cabinet_list }}" class="flex-end hover:text-green-700">
            <x-lucide-goal class="w-6"/>
        </a>

        <a href="{{ $division->partnersCabinetList() }}" class="flex-end hover:text-green-700">
            <x-lucide-handshake class="w-6"/>
        </a>

        <a href="{{ $division->positions_cabinet_list }}" class="flex-end hover:text-green-700">
            <x-lucide-id-card-lanyard class="w-6"/>
        </a>

        <a href="{{ $division->graduations_cabinet_list }}" class="flex-end hover:text-green-700">
            <x-lucide-graduation-cap class="w-6"/>
        </a>

        <a href="{{ $division->historyForm() }}" class="flex-end hover:text-green-700">
            <x-lucide-file-clock class="w-6"/>
        </a>
        <a href="{{ $division->documentsCabinetList() }}" class="flex-end hover:text-green-700">
            <x-lucide-file class="w-6"/>
        </a>
{{--        <a href="{{ $division->scienceCabinetList() }}" class="flex-end hover:text-green-700">--}}
{{--            <x-lucide-microscope class="w-6"/>--}}
{{--        </a>--}}
    </div>

</div>
