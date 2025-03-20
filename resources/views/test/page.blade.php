@extends("layouts.main")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="grid gap-4 grid-cols-[auto_auto_auto_1fr] m-8">
    @foreach($list as $item)
        <div>
            {!! $loop->iteration !!}
        </div>
        <div>
            {!! $item->level->getName() !!}
        </div>
        <div>
            {!! $item->spec_code !!}
        </div>
        <div>
            {!! $item->name !!}
        </div>

    @endforeach
    </div>
@endsection
