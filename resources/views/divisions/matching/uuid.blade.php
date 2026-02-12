@props([
    'divisions'  => collect(),
    'json'       => collect()
])

@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . "UUID matching"  )

@section('content')
    <div class="flex flex-col gap-3">
{{--    <form action="{{ route('division.matching.uuid') }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}

{{--        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">--}}
{{--            <div class="flex items-center">--}}
{{--                {{ __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . "UUID matching" }}--}}
{{--            </div>--}}

{{--            <div class="flex items-center gap-3">--}}
{{--                <input--}}
{{--                    type="submit"--}}
{{--                    value="Сохранить"--}}
{{--                    class="--}}
{{--                        bg-sky-900--}}
{{--                        px-4 py-2--}}
{{--                        text-white--}}
{{--                        rounded-md--}}
{{--                        hover:bg-blue-700--}}
{{--                        active:bg-gray-700--}}
{{--                        cursor-pointer--}}
{{--                        uppercase--}}
{{--                    "--}}
{{--                >--}}
{{--                <input--}}
{{--                    type="submit"--}}
{{--                    name="save-close"--}}
{{--                    value="Сохранить и закрыть"--}}
{{--                    class="--}}
{{--                        uppercase--}}
{{--                        bg-sky-900--}}
{{--                        px-4 py-2--}}
{{--                        text-white--}}
{{--                        rounded-md--}}
{{--                        hover:bg-blue-700--}}
{{--                        active:bg-gray-700--}}
{{--                        cursor-pointer--}}
{{--                        hidden--}}
{{--                    "--}}
{{--                >--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="grid grid-cols-2 gap-3 sticky top-17 z-50">
            <div class="flex bg-white gap-2 p-3 flex-1 shadow">
                <x-lucide-search class="w-6 block group-open:hidden" />

                <input name="quickSearchInList" type="text" class="py-1 outline-0 border-b-1 w-full" data-search-block="#block2">

                <x-lucide-x class="w-6 cursor-pointer hover:text-hover-red search-clear" />
            </div>
            <div class="flex bg-white gap-2 p-3 flex-1 shadow">
                <x-lucide-search class="w-6 block group-open:hidden" />

                <input name="quickSearchInList" type="text" class="py-1 outline-0 border-b-1 w-full" data-search-block="#block1">

                <x-lucide-x class="w-6 cursor-pointer hover:text-hover-red search-clear" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 items-start">
            <div class="flex flex-col gap-3 max-h-[84vh] overflow-y-scroll">

                <div id="block2" class="grid grid-cols-[6ch_1fr_minmax(auto,34ch)] gap-3">
                    @foreach($divisions as $item)
                        <div class="col-span-full grid grid-cols-subgrid gap-3 lineInSearch">
                            <div class="p-3 bg-white shadow-sm flex items-center justify-center">
                                {{ $item->id }}
                            </div>
                            <div class="p-3 bg-white shadow-sm flex items-center">
                                @for($i=0 ; $i <= $item->depth; $i++)
                                    <span class="p-2"></span>
                                @endfor
                                @if($item->depth)
                                    <span class="p-1 pe-3">{{ __('common.arrowT2R') }}</span>
                                @endif

                                <div class="flex-1">
                                    {{ $item->name }}
                                </div>
                                <div>
                                    <a href="#copy" title="Скопировать" data-copy="{{ $item->name }}"
                                       class="hover:text-green-700"
                                    >
                                        <x-lucide-copy class="w-6" />
                                    </a>
                                </div>
                            </div>
                            <div class="p-3 bg-white shadow-sm">
                                <x-form.input
                                    name="uuid[{{ $item->id }}]"
                                    label="UUID"
                                    value="{!! $item->uuid !!}"
                                    block="flex-1"
                                    class="inputMatchedUUID"
                                    :data="['link'=> route('division.change.uuid', $item) ]"
                                />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-3 max-h-[84vh] overflow-y-scroll">
                <div id="block1" class="grid grid-cols-[1fr_minmax(auto,34ch)] gap-3">
                    @foreach($json as $item)
                        {{--                        @continue($item->disbanded)--}}
                        {{--                        @continue($item->deleted)--}}

                        <div class="col-span-full grid grid-cols-subgrid gap-3 lineInSearch">
                            <div
                                class="
                                    p-3 shadow-sm flex items-center
                                    @if($item->disbanded)
                                        bg-red-900 text-white
                                    @elseif($item->deleted)
                                        bg-orange-900 text-white
                                    @else
                                        bg-white
                                    @endif
                                "
                            >
                                @for($i=0 ; $i <= $item->depth; $i++)
                                    <span class="p-2"></span>
                                @endfor
                                @if($item->depth)
                                    <span class="p-1 pe-3">{{ __('common.arrowT2R') }}</span>
                                @endif
                                <div class="flex-1">
                                    {{ $item->name }}
                                </div>
                            </div>
                            <div
                                class="
                                    p-3 shadow-sm flex gap-3 items-center
                                    @if($item->disbanded)
                                        bg-red-900 text-white
                                    @elseif($item->deleted)
                                        bg-black text-white
                                    @else
                                        bg-white
                                    @endif
                                "
                            >
                                <div class="flex-1">
                                    {{ $item->GUID_Dep }}
                                </div>
                                <div>
                                    <a href="#copy" title="Скопировать" data-copy="{{ $item->GUID_Dep }}"
                                       class="hover:text-green-700"
                                    >
                                        <x-lucide-copy class="w-6" />
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{--    </form>--}}
@endsection
