@if(isset($menu) && is_array($menu))
    @foreach($menu as $item)

        <h3 class="font-bold text-lg pb-3 mx-2.5 mt-3 border-b-[1px] border-[var(--primary-color)]">
            @if($item->active)
                {{$item->name}}
            @else
                <a href="{{$item->link}}">
                    {{$item->name}}
                </a>
            @endif
        </h3>
        @if($item->subs)
            <ul class="left-side-menu @if(!$item->active) hidden @endif">

                @foreach($item->subs as $sub)
                    @if($sub->active)
                        <li class="py-3.5 px-5" style="border-bottom: 1px solid var(--primary-color);">
                                <span class="text-baseRed">
                                    {{$sub->name}}
                                </span>
                        </li>
                    @else
                        <li class="py-3.5 px-5">
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
        @endif
    @endforeach
@endif
