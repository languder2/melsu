@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="flex flex-col gap-4">
        @foreach($list as $item)
            <a href="{{$item->edit}}" target="_blank" class="underline hover:text-base-red">
                    {!! $item->id !!}
                |
                    {!! $item->alt_name !!}
                |
                    {!! $item->name !!}
            </a>

        @endforeach
    </div>

@endsection

