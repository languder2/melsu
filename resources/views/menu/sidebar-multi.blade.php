@if($menu)
    @foreach($menu as $item)
        <h4 class="font-bold text-lg py-2 px-4 my-2 first:mt-0 border-b border-[var(--primary-color)]" >
            <a
                href="{{$item->link}}"
                class="hover:text-base-red flex gap-2 justify-start items-center group"
            >
                <span class="group-hover:ms-2 transition-all duration-300">
                    {{$item->name}}
                </span>
                <i class="fas fa-arrow-right group-hover:flex-1 text-right transition-all duration-700"></i>
            </a>
        </h4>

        <ul class="left-side-menu">
            @foreach($item->subs as $sub)
                @if($sub->active)
                    <li class="py-4 px-5">
                        <span class="text-baseRed">
                            {{$sub->name}}
                        </span>
                    </li>
                @else
                    <li class="py-2 px-5">
                        <a
                            href="{{$sub->link}}"
                            class="text-[#301428] hover:text-base-red hover:ms-2 duration-200 transition-all"
                        >
                            {{$sub->name}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

    @endforeach
@endif
