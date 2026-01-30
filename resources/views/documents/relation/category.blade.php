@props([
    'isFirst'   => false,
    'isLast'    => false,
    'item'
])
@php
    /** * @var object $item */
    $classes = match(true){
            !$item->is_approved     => 'border-red-700 bg-white',
            !$item->is_show         => 'border-orange-400 bg-white',
            default                 => 'border-white bg-white'
        };
@endphp

<div
    class="grid grid-cols-subgrid col-span-full gap-3 "
>

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <x-html.button-delete-with-modal
            :question=" __('common.remove category')"
            :text=" $item->name "
            :action=" route('documents-category.relation.delete', [$item->relation->getTable(), $item->relation, $item]) "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="p-3 font-semibold bg-sky-900 text-white flex gap-x-3">
        @if(auth()->user()->isEditor())
            <span>
                {{ $item->id }}
            </span>
        @endif
        <span>
            {{ $item->name }}
        </span>
        <span class="flex-auto"></span>
        <span>
            {{ $item->sort }}
        </span>
    </div>
    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a
            href="{{ route('documents-category.relation.form', [$item->relation->getTable(), $item->relation, $item]) }}"
            class="flex-end hover:text-green-700"
        >
            <x-lucide-square-pen class="w-6"/>
        </a>

        {{--        <a href="{{ $item->cabinetForm() }}" class="flex-end hover:text-green-700">--}}
        {{--            <x-lucide-list-tree class="w-6"/>--}}
        {{--        </a>--}}
        <a href="{{ $item->partnerAdd }}" class="flex-end hover:text-green-700">
            <x-lucide-square-plus class="w-6"/>
        </a>
    </div>
    <div class="flex justify-center gap-2 bg-white rounded-sm items-center p-3 shadow">
        @if(!$isFirst)
            <x-html.button-change-sort-up
                :link=" route('documents-categories.relation.change-sort', [
                    \App\Enums\Entities::getEntityByModel($item->relation::class)->value,
                    $item->relation->id,
                    $item->id,
                    'up'
                ]) "
            />
        @endif

        @if(!$isLast)
            <x-html.button-change-sort-down
                :link=" route('documents-categories.relation.change-sort', [
                    \App\Enums\Entities::getEntityByModel($item->relation::class)->value,
                    $item->relation->id,
                    $item->id,
                    'down'
                ]) "
            />
        @endif
    </div>
</div>
<div class="col-span-full grid grid-cols-[auto_1fr_auto_auto] gap-3">

    {{--    @forelse($item->partners as $partner)--}}
    {{--        @component('partners.cabinet.partner',[--}}
    {{--            'item'      => $partner,--}}
    {{--            'isFirst'   => $loop->first,--}}
    {{--            'isLast'    => $loop->last,--}}
    {{--        ])@endcomponent--}}
    {{--    @empty--}}
    {{--        <div class="p-3 bg-white shadow col-span-full text-center">--}}
    {{--            Нет партнеров--}}
    {{--        </div>--}}
    {{--    @endforelse--}}
</div>
<hr class="col-span-full last:hidden my-2">
