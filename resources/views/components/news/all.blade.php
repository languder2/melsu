<div class="container custom p-2.5">
    <x-news.filter/>

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
    {{--    <x-news.pagination :list="$list" />--}}
</div>


{{--{{$list->onEachSide(3)->links()}}--}}

{{--@dump($list->toArray()['links'])--}}
{{--@dump($list->toArray()['next_page_url'])--}}
{{--@dump($list->toArray()['current_page'])--}}
{{--@dump($list->toArray()['prev_page_url'])--}}
{{--@dump($list->toArray())--}}
