<section class="container hidden lb:block">
    <div class="page-header pt-14 mb-5 xl:mb-14">
        <div class="breadcrumbs flex flex-wrap mb-4">
            <span class="crumb-home font-xs after:content-['\2192'] me-2 after:ms-2">
                <a href="{{url('/')}}" class="font-xs">
                    Главная
                </a>
            </span>
            @if(isset($list))
                @foreach($list as $key=>$item)
                    <span class="crumb-home font-xs after:content-['\2192'] me-2 after:ms-2">
                        <a href="{{$item->link}}" class="font-xs">
                            {{$item->name}}
                        </a>
                    </span>
                @endforeach
            @endif
            @if(isset($last))
                <span class="crumb font-xs">
                    <a href="{{$last->link??''}}" class="font-xs">
                        {{$last->name??''}}
                    </a>
                </span>
            @endif
        </div>
        @if(isset($current))
            <h1 class="text-[32px] sm:text-[55px] font-bold">
                {{$current->name??''}}
            </h1>
        @endif
    </div>
</section>
