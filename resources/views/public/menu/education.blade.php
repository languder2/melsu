@if($menu)
    <ul class="left-side-menu sticky top-44 bg-white px-4 py-2">
        @foreach($menu->items as $item)
            @if($item->active)
                <li class="py-2">
                    <span class="text-baseRed">
                        {{$item->name}}
                    </span>
                </li>
            @else
                <li class="py-2">
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
