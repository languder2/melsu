@props([
    'list'      => collect(),
    'text'      => __('common.Staffs'),
    'isLeaders' => false,
    'link'      => '#',
    'division'  => new \App\Models\Division\Division(),
])

@php
    if($isLeaders)
        $text = __('common.Leaders')
@endphp

<div
    class="flex flex-col gap-3 w-full"
>
    <div
        class="grid grid-cols-[1fr_auto] col-span-full gap-3 sticky top-16 bg-neutral-100 py-2 z-30"
    >
        <div class="p-3 font-semibold bg-sky-900 text-white rounded-sm flex gap-4">
            <div>
                {{ $text }}
            </div>
            <div class="flex-1"></div>
            <div>
                counter
            </div>
        </div>

        <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
            <a href="{{ route('division.posts.cabinet.form', $division) }}" class="flex-end hover:text-green-700">
                <x-lucide-square-plus class="w-6"/>
            </a>

        </div>
    </div>

    <div class="grid grid-cols-[auto_1fr_1fr_8ch_auto] gap-3">
        @forelse($list as $staff)
            <div class="p-3 border-1 col-span-full grid grid-cols-subgrid gap-4 bg-neutral-200 rounded-sm">
                @component('staffs.cabinet.staff',[
                    'division'  => $division,
                    'current'   => $staff,
                    'isFirst'   => $loop->first,
                    'isLast'    => $loop->last,
                ])@endcomponent
            </div>
        @empty
            <div class="p-3 bg-white shadow col-span-full text-center">
                {{ __('common.Not staffs') }}
            </div>
        @endforelse
    </div>
</div>
