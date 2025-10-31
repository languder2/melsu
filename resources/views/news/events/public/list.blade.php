@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ": Мероприятия')

@section('content')
    <div class="container custom p-2.5">
        <div
            class="news-wrapper grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr] xl:grid-cols-[1fr_1fr_1fr_1fr] gap-0 gap-y-2.5 lg:gap-5">
            @foreach($list as $item)
                @if($loop->first)
                    @component('news.events.public.first',['item'=> $item])
                    @endcomponent
                @else
                    @component('news.events.public.second',['item'=> $item])
                    @endcomponent
                @endif
            @endforeach
        </div>
        <br>
        {!! $list->links() !!}
    </div>

@endsection



