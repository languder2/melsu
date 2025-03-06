@if(@$menu)
    <h3 class="font-bold text-lg pb-3 mx-2.5 mt-3 border-b-[1px] border-[var(--primary-color)]">
        <a href="{{$menu->link}}">
            {{$menu->name}}
        </a>
    </h3>
    @if($menu->subs)
        <ul class="left-side-menu">
            @foreach($menu->subs as $item)
                @if($item->active)
                    <li class="py-3.5 px-5" style="border-bottom: 1px solid var(--primary-color);">
                        <a
                            href="{{$item->link}}"
                            class="text-baseRed"
                        >
                            {{$item->name}}
                        </a>
                    </li>
                @else
                    <li class="py-3.5 px-5">
                        <a
                            href="{{$item->link}}"
                            class="text-[#301428]"
                        >
                            {{$item->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
@endif
