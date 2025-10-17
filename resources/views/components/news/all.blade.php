<section class="h-[324px] px-2.5 lg:p-0 relative bg-no-repeat bg-[25%] lg:bg-0 bg-cover flex"
style="background-image: url({{asset('img/news-block-header.png')}})">
        <div class="bg-[rgba(40,13,13,0.6)] min-h-full min-w-full pointer-events-none absolute top-0 left-0">
        </div>
</section>
<div class="container">
    @component('components.news.filter', compact("categories",'category','search')) @endcomponent
    <div
        class="news-wrapper grid grid-cols-1 lg:grid-cols-3 gap-0 gap-y-2.5 lg:gap-5">
        @foreach($list as $key=>$news)
            @if($key === 0)
                <x-news.first :news="$news"/>
            @else
                <x-news.second :news="$news"/>
            @endif
        @endforeach
    </div>
    <br>
    {!! $list->links() !!}
</div>