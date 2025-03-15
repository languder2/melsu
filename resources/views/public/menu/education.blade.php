@if($division->menu)
    <ul class="left-side-menu sticky top-44 bg-white px-4 py-2">
        <li>
            <h4 class="font-bold text-lg pb-1 mb-2 border-b border-base-red" >
                {!! $division->menu->name !!}
            </h4>
        </li>
        @foreach($division->menu ->items as $item)
            @if($item->link === url()->current())
                <li class="py-2">
                    <span class="text-base-red font-semibold ">
                        {{$item->name}}
                    </span>
                </li>
            @else
                <li class="py-2">
                    <a
                        href="{{$item->link}}"
                        class="text-[#301428] hover:text-base-red"
                    >
                        {{$item->name}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
@endif

