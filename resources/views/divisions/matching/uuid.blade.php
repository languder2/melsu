@props([
    'divisions'         => collect(),
    'json'              => collect(),
    'showDisbanded'     => true,
    'showDeleted'       => true,
])

@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . __('common.arrowR') . __('common.Divisions') . __('common.arrowR') . "UUID matching"  )

@section('content')

    <div class="flex flex-col gap-3">
        @include('divisions.matching.uuid-filter')

        <div class="grid grid-cols-2 gap-3">
            <x-common.quick-search-in-list blockID="block1" />
            <x-common.quick-search-in-list blockID="block2" />
        </div>



        <div class="grid grid-cols-2 gap-3 items-start">
            <div class="flex gap-3 justify-end">
                <div>
                    Results:
                </div>
                <div id="block1Counter">
                    {{ $divisions->count() }}
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <div>
                    Results:
                </div>
                <div id="block2Counter">
                    {{ $json->count() }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 items-start">
            <div class="flex flex-col gap-3 max-h-[74vh] overflow-y-scroll">
                @include('divisions.matching.uuid-list')
            </div>
            <div class="flex flex-col gap-3 max-h-[74vh] overflow-y-scroll">
                @include('divisions.matching.uuid-json')
            </div>
        </div>
    </div>
@endsection
