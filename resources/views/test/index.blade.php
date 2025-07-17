@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    @dump($json ?? null)

    <div class="grid grid-cols-[{{ $list->first()->count() }}]">
        @foreach($list->first() as $field)
            <div class="bg-blue text-white">
                {{ $field }}
            </div>
        @endforeach
        @foreach($list as $item)
            @foreach($item as $field)
                <div class=" {{ $loop->iteration % 2 ? 'bg-green-50': 'bg-blue-50' }}">
                    {{ $field }}
                </div>
            @endforeach
        @endforeach
    </div>

@endsection

