@props([
])
<div
    class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center select-none border-white bg-white"
>
    <div class="text-center">
        {{ $item->id }}
    </div>
    <div>
        {!! $item->email !!}
    </div>
    <div>
        {!! $item->fio !!}
    </div>
    <div>
        {!! $item->role->label() !!}
    </div>
    <div class="grid grid-cols-3 justify-center gap-6">
        @if(auth()->user()->role->level() > $item->role->level() || auth()->id() === $item->id)
            <a href="{{ $item->form }}" class="flex-end hover:text-green-700">
                <x-lucide-square-pen class="w-6"/>
            </a>
        @endif

        @if(auth()->user()->role->level() > $item->role->level() || auth()->id() === $item->id)

            <x-cabinet.elements.division-section-a
                :link=" route('users.cabinet.access', $item)"
                lucide="user-round-cog"
                :title=" __('common.allowed access') "
                :isApproved="true"
            />
        @endif

        @if(auth()->user()->role->level() > $item->role->level())
            <x-html.button-delete-with-modal
                question="Удалить пользователя (SoftDelete)"
                :text=" $item->email . ' : ' . $item->fio "
                :action=" $item->delete "
                icoClass='hover:text-amber-700'
            />
        @endif

    </div>
</div>
