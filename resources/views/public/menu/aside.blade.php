@if($menu)
    <h4 class="font-bold text-lg pb-1 mb-2 border-b border-[var(--primary-color)]" >
        {{$menu->name}}
    </h4>

    <ul class="left-side-menu">
        @foreach($menu->items as $item)
            @if($item->active)
                <li class="py-3.5 px-5">
                        <span class="text-baseRed">
                            {{$item->name}}
                        </span>
                </li>
            @else
                <li class="py-2 px-5">
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
