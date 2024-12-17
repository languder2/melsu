<li class="text-white hover:text-green-200 py-2" >
    <a href="{{$link??'#'}}" class="block overflow-hidden text-nowrap">
        @if(isset($ico))
            <i class="{{$ico}} mr-2 w-6"></i>
        @endif
        <span class="">
            {{@$text}}
        </span>
    </a>
</li>
