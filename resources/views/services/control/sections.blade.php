@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    <div class="grid grid-cols-[auto_1fr] gap-4 mx-20 my-6">
        @foreach($list as $key=>$items)
            <div class="grid grid-cols-2 gap-4">
                @if(request()->has('detail'))
                    @foreach($items as $item )
                        <div>
                            {{ $item->relation_id }}
                        </div>
                        <div>
                            {{ $item->relation_type }}
                        </div>
                    @endforeach
                @else
                    {!! $items->count() !!}
                @endif
            </div>
            <div>
                {!! $key !!}
            </div>
            <hr class="col-span-2">
        @endforeach
    </div>

@endsection
