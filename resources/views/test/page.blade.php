@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="grid grid-cols-[auto_auto_auto_1fr] gap-4">
        @foreach($list as $item)
            <div>
                {{ $loop->index }}
            </div>
            <div>
                @if($item instanceof \App\Models\Minor\Contact)
                    Контакт
                @else
                    Секция: {!! $item->title ?? null !!}
                @endif
            </div>
            <div>
                @if($item instanceof \App\Models\Minor\Contact)
                    {{ $item->content ?? null }}
                @else

                @endif
            </div>
            <div>
                <a href="{{$item->relation->link}}" target="_blank">
                    {!! $item->relation->name !!}
                </a>
            </div>
        @endforeach
    </div>

@endsection

