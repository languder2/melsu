@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    @foreach($list as $letter=>$items)

        <h3 class="font-semibold text-xl mx-20">{{$letter}}</h3>
        <hr class="mx-20">

        <div class="grid grid-cols-[auto_1fr_1fr_1fr_1fr] gap-4 mx-20 my-6">
            <div></div>
            <div>
                ФИО
            </div>
            <div>
                Должность
            </div>
            <div>
                Должность с указанием отдела
            </div>
            <div>
                Отдел
            </div>
            @foreach($items as $item )
                <div>
                    {{ $item->id }}
                </div>
                <div>
                    {{ $item->full_name }}
                </div>
                <div>
                    {{ $item->post }}
                </div>
                <div>
                    {{ $item->post_full }}
                </div>
                <div>
                    {{ $item->division }}
                </div>
                <hr class="col-span-5">
            @endforeach
        </div>
    @endforeach

@endsection
