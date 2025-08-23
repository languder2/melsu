<section class="container hidden lg:block">
    <div class="page-header pt-14 mb-5 xl:mb-14">
        @if(count($list??[]) || !empty($last??[]))
            <div class="breadcrumbs flex flex-wrap mb-4">
                <span class="crumb-home font-xs after:content-['\2192'] me-2 after:ms-2">
                    <a href="{{url('/')}}" class="font-xs">
                        Главная
                    </a>
                </span>
                @foreach($list as $key=>$item)
                    <span class="crumb-home font-xs after:content-['\2192'] me-2 after:ms-2">
                        <a href="{{$item->link}}" class="font-xs">
                            {{$item->name}}
                        </a>
                    </span>
                @endforeach
                @if(isset($last))
                    <span class="crumb font-xs">
                    <a href="{{$last->link??''}}" class="font-xs">
                        {{$last->name??''}}
                    </a>
                </span>
                @endif
            </div>
        @endif

        @if(isset($current))
            <h1 class="text-3xl sm:text-5xl font-bold">
                {{$current->name??''}}
            </h1>
        @endif
    </div>
</section>
<section class="container block lg:hidden">
    <h1 class="text-3xl sm:text-5xl font-bold">
        {{$current->name??''}}
    </h1>
</section>
