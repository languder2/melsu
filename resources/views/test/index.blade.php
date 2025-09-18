@extends("layouts.test")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="grid grid-cols-[1fr_auto_auto] gap-4 mx-auto max-w-400 ">
        @foreach($list as $item)
            <div class="p-3 {{ $loop->index % 2 ? "bg-indigo-200/20" : "bg-purple-200/20" }} shadow">
                {{ $item->email }}
            </div>
            <div class="p-3 {{ $loop->index % 2 ? "bg-indigo-200/20" : "bg-purple-200/20" }} shadow">
                {{ $item->pass }}
            </div>
            <div class="flex flex-col gap-3">
                @foreach($item->divisions as $divisions )
                    <div class="p-3 {{ $loop->parent->index % 2 ? "bg-indigo-200/20" : "bg-purple-200/20" }} shadow">
                        {!! $divisions !!}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

