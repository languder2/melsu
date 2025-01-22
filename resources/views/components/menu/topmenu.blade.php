@if(isset($menu))
    @foreach($menu as $item)
        <a class="nav-link" href="{{$item->link}}">
            {{$item->name}}
        </a>
    @endforeach
@endif
