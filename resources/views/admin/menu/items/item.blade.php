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

        <div class="mx-4">
            <i class="fas fa-level-up-alt rotate-90"></i>
        </div>
    @endif

    <div class="flex-1">
        {{$item->name}}
    </div>
</div>

<div>
    {{optional($item->parent)->name}}
</div>

<div>
    {{$item->link}}
</div>

<div>
    <div class="flex flex-row-reverse text-white w-full">
        <div class="flex-none w-14">
            <a
                href="{{route('admin:menu-items:delete',$item->id)}}"
                class="
                    py-2 px-4 rounded-md
                    bg-red-950
                    hover:bg-red-700
                    active:bg-gray-700
                "
            >
                <i class="fas fa-trash w-4 h-4"></i>
            </a>
        </div>
        <div class="flex-none w-14">
            <a
                href="{{route('admin:menu-items:edit',$item->id)}}"
                class="
                    py-2 px-4 rounded-md
                    bg-green-950
                    hover:bg-green-700
                    active:bg-gray-700
                "
            >
                <i class="far fa-edit w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
<hr class="col-span-6 last:hidden border-indigo-900/40">
@if($item->subs()->count())
    @foreach($item->subs as $item)
        {{ view('admin.menu.items.item',['item'=>$item, "level" => isset($level)?$level+1:0 ]) }}
    @endforeach
@endif
