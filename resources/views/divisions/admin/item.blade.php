@php
    $rowCount = session()->get('rowCount');
    session()->put('rowCount', $rowCount + 1);
@endphp

<div
    @class([
        "text-center p-3",
        $record->show?'text-green-700':'text-red-700',
        $rowCount % 2 ? 'bg-sky-100/30' : ''
    ])
>
    {{$record->id}}
</div>

<div @class(["flex items-center p-3", $rowCount % 2 ? 'bg-sky-100/30' : ''])>

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

<div @class(["p-2", $rowCount % 2 ? 'bg-sky-100/30' : ''])>
    <div class="flex w-full gap-4 items-center">
        <div class="flex-none text-white">
            <a
                href="{{ route('division:admin:documents:list', $record) }}"
                class="
                    py-2 px-4 rounded-md
                    bg-blue-950
                    hover:bg-blue-700
                    active:bg-gray-700
                    flex gap-2 items-center
                "
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-filetype-pdf w-4" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"></path>
                </svg>
            </a>
        </div>
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
            </a>
        </div>
        <div class="flex-none w-14 text-white ms-10">
{{--            <a--}}
{{--                href="{{route('admin:division:delete',$record->id)}}"--}}
{{--                class="--}}
{{--                    py-2 px-4 rounded-md--}}
{{--                    bg-red-950--}}
{{--                    hover:bg-red-700--}}
{{--                    active:bg-gray-700--}}
{{--                "--}}
{{--            >--}}
{{--                <i class="fas fa-trash w-4 h-4"></i>--}}
{{--            </a>--}}
        </div>
    </div>
</div>

@if($record->subs)
    @foreach($record->subs as $record)
        @include('divisions.admin.item',['record'=>$record, "depth" => isset($depth)?$depth+1:0])
    @endforeach
@endif
