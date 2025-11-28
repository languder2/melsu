@props([
    'division' => New \App\Models\Division\Division()
])

<h2 class="font-bold text-xl">
    {{ __("menu.navigation for ".($division->type->value ?? null)) }}

</h2>
<div class="flex flex-col">
    @foreach($division->menu() as $item)
        @if($item->is_link)
            <a
                href="{{ $item->link ?? '#' }}" class="flex items-center gap-2.5 group hover:bg-[#EEEEEE] py-3 px-2.5 transition duration-300 ease-linear select-none"
                onclick="{{ $item->onclick ?? null }}"
            >
                <span>
                    {!! $item->ico !!}
                </span>
                <span>
                    {{ $item->name }}
                </span>
            </a>
        @else
            <span class="flex items-center gap-2.5 group p-3 select-none">
                <span>
                    {!! $item->ico !!}
                </span>
                <span>
                    {{ $item->name }}
                </span>
            </span>
        @endif

    @endforeach


</div>
