<section class="container hidden lb:block">
    <div class="page-header pt-14 mb-5 xl:mb-14">
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

            <span class="crumb font-xs">
                <a href="{{$last->link??''}}" class="font-xs">
                    {{$last->name??''}}
                </a>
            </span>

        </div>
        <h1 class="text-[32px] sm:text-[55px] font-bold">
            {{$current->name??''}}
        </h1>
    </div>
</section>
