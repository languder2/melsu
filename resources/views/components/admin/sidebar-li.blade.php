<li class="text-white hover:text-blue-300 my-4 block first:mt-0">
    <a href="{{$link??'#'}}" class="block overflow-hidden text-nowrap">
        @if(isset($ico))
            <i @class([
                    @$ico,
                    "w-6 float-left mt-1",
                    @$class
                ])
            ></i>
        @elseif(isset($img))
            <i class="w-6 float-left mt-1">
                <img src="{{asset("img/{$img}")}}" alt=""/>
            </i>
        @endif
        <span class="block ml-8 text-right">
            {{@$text}}
        </span>
    </a>
</li>
