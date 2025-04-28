@if($menu)
    @foreach($menu as $item)
        @if($type !== $item->type)
            <h4 class="font-bold text-lg py-2 px-4 my-2 first:mt-0 border-b border-base-red" >
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
        @else
            <h4 class="font-bold text-lg py-2 px-4 my-2 first:mt-0 border-b border-base-red text-base-red" >
                {{$item->name}}
            </h4>
        @endif

        @if($type === $item->type)
            <ul class="left-side-menu">
                @foreach($item->subs as $sub)
                    <li class="py-2 px-5">
                        <a
                            href="{{$sub->link}}"
                            class="text-[#301428] hover:text-base-red hover:ms-2 duration-200 transition-all"
                        >
                            {{$sub->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
@endif
