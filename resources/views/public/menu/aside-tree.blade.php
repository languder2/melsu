@if($menu)
    @foreach($menu->items as $item)
        <h4 class="font-bold text-lg pb-1 mb-2 border-b border-[var(--primary-color)]" >
            <a
                href="{{$item->link}}"
                class="hover:text-base-red"
            >
                {{$item->name}}
            </a>
        </h4>

        <ul class="left-side-menu">
            @foreach($item->subs as $sub)
                @if($sub->active)
                    <li class="py-3.5 px-5" style="border-bottom: 1px solid var(--primary-color);">
                        <span class="text-baseRed">
                            {{$sub->name}}
                        </span>
                    </li>
                @else
                    <li class="py-2 px-5">
                        <a
                            href="{{$sub->link}}"
                            class="text-[#301428]"
                        >
                            {{$sub->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

    @endforeach
@endif
