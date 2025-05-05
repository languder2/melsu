<div class="container">
    @component('components.news.filter', compact("categories")) @endcomponent
    <div
        class="news-wrapper grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr] xl:grid-cols-[1fr_1fr_1fr_1fr] gap-0 gap-y-2.5 lg:gap-5">
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
