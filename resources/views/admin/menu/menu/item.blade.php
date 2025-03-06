<div class="text-right">
    {{$record->id}}
</div>

<div class="text-right">
    @if($record->is_tree)
        <i class="fas fa-sitemap"></i>
    @endif
</div>

<div class="text-right">
    {{$record->code}}
</div>

<div class="flex items-center">

    @if($record->parent_id)

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
        {{$record->name}}
    </div>
</div>

<div>
    {{optional($record->parent)->name}}
</div>

<div>
    <div class="flex flex-row-reverse text-white w-full">
        <div class="flex-none w-14">
            <a
                href="{{route('admin:menu:delete',$record->id)}}"
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
                href="{{route('admin:menu:edit',$record->id)}}"
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
<hr class="md:col-span-6 last:hidden opacity-20">

@if($record->subs)
    @foreach($record->subs as $record)
        {{ view('admin.menu.menu.item',['record'=>$record, "level" => isset($level)?$level+1:0 ]) }}
    @endforeach
@endif
