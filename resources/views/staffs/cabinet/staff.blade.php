@props([
    'isFirst'   => false,
    'isLast'    => false,
    'current'   => new \App\Models\Staff\Post(),
    'isEditor'  => auth()->user()->isEditor(),
    'division'  => new \App\Models\Division\Division(),
])
@php
    /** * @var object $current */
    $classes = match(true){
            !$current->is_approved     => 'border-red-700 bg-white',
            !$current->is_show         => 'border-orange-400 bg-white',
            default                 => 'border-white bg-white'
        };

    $multi  = !$isFirst || !$isLast;
@endphp

<div
    class="grid grid-cols-subgrid col-span-full gap-3"
>
    <div @class(['grid gap-3', $isEditor ? 'grid-cols-[auto_6ch_6ch]' : 'grid-cols-[6ch_6ch]'])>
        @if($isEditor)
            <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">

                @if($current->trashed())
                    <x-html.button-restore-with-modal
                        :question=" __('common.Restore staff post') "
                        :text=" implode('<br>',[$division->name, $current->full_name, $current->post]) "
                        :action=" route('division.posts.cabinet.restore', [$division->id, $current->id]) "
                    />
                @else
                    <x-html.button-delete-with-modal
                        :question=" __('common.Remove staff post') "
                        :text=" implode('<br>',[$division->name, $current->full_name, $current->post]) "
                        :action=" route('division.posts.cabinet.delete', [$division->id, $current->id]) "
                    />
                @endif

            </div>
        @endif
        <div class="bg-white rounded-sm p-3 shadow flex items-center justify-center" title="postID">
            {{ $current->id }}
        </div>
        <div class="bg-white rounded-sm p-3 shadow flex items-center justify-center" title="staffID">
            {{ $current->staff_id }}
        </div>
    </div>
    <div class="bg-white rounded-sm p-3 shadow flex gap-3 items-center">
        <div>
            {{ $current->fullname }}
        </div>
        <div class="flex-1"></div>
        <div>
            {{ $current->sort }}
        </div>
    </div>

    <div class="bg-white rounded-sm p-3 shadow flex gap-3 items-center @if(!$multi) col-span-2 @endif">
        {{ $current->post }}
    </div>

    @if($multi)
        <div class="flex justify-center gap-2 items-center bg-white rounded-sm p-3 shadow">
            @if(!$isLast)
                <x-html.button-change-sort-down
                    :link=" route('documents.cabinet.change-sort', [$current->id, 'down']) "
                />
            @else
                <span class="w-6"></span>
            @endif

            @if(!$isFirst)
                <x-html.button-change-sort-up
                    :link=" route('documents.cabinet.change-sort', [$current->id, 'up']) "
                />
            @else
                <span class="w-6"></span>
            @endif
        </div>
    @endif

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ route('division.posts.cabinet.form', [$division->id, $current->id]) }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>

        <a href="{{ $current->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>

</div>
