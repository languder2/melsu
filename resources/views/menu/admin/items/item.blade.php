<div class="text-right">
    {{$item->id}}
</div>

<div>
    <img
        src="{{$item->preview->thumbnail}}"
        alt="{{$item->name}}"
        class="h-12"
    />
</div>

<div class="flex items-center">
    @if($item->parent_id)
        @if(isset($level) && $level > 1)
            @for($i = 1; $i < $level; $i++)
                <div class="mx-4"></div>
            @endfor
        @endif

        <div class="ms-6 me-3">
            <i class="fas fa-level-up-alt rotate-90"></i>
        </div>
    @endif

    <div class="flex-1">
        <a
            href="{{ route('admin:menu-items:edit',$item->id) }}"
            class="underline hover:text-red"
        >
            {{$item->name}}
        </a>
    </div>
</div>

<div>
    {{$item->link}}
</div>

<div>
        <a
            href="{{route('admin:menu-items:delete',$item->id)}}"
            class="text-red hover:text-red-700 active:text-neutral-700"
        >
            <i class="fas fa-trash text-xl"></i>
        </a>
</div>
<hr class="col-span-5 last:hidden border-indigo-900/40">
@if($item->subs()->count())
    @foreach($item->subs as $item)
        @component('menu.admin.items.item',['item'=>$item, "level" => isset($level)?$level+1:0 ])@endcomponent
    @endforeach
@endif
