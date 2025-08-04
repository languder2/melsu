<div
    @class([
        "text-right",
        $record->show?'text-green-700':'text-red-700'
    ])
>
    {{$record->id}}
</div>

<div class="flex items-center">

    @if($record->parent_id)

        @if(isset($depth) && $depth > 1)
            @for($i = 1; $i < $depth; $i++)
                <div class="mx-4"></div>
            @endfor
        @endif

        <div class="mx-4">
            <i class="fas fa-level-up-alt rotate-90"></i>
        </div>
    @endif

    <div class="flex-1">
        <a
            href="{{ $record->edit }}"
            class="underline"
        >
            {{$record->name}}
        </a>
    </div>
</div>

<div>
    <div class="flex w-full gap-4 items-center">
        <div class="flex-none text-white">
            <a
                href="{{ $record->staffs_admin_list }}"
                class="
                    py-2 px-4 rounded-md
                    bg-blue-950
                    hover:bg-blue-700
                    active:bg-gray-700
                    flex gap-2 items-center
                "
            >
                <i class="fas fa-users"></i>
                Сотрудники
            </a>
        </div>
        <div class="flex-none w-14 text-white">
            <a
                href="{{route('admin:division:delete',$record->id)}}"
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
    </div>
</div>
<hr class="md:col-span-3 last:hidden opacity-70">

@if($record->subs)
    @foreach($record->subs as $record)
        @include('divisions.admin.item',['record'=>$record, "depth" => isset($depth)?$depth+1:0])
    @endforeach
@endif
