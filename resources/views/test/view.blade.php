@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="flex flex-col gap-4 mx-4">
        @foreach($list as $item)
            <div class="flex gap-4">
                <div class="w-15 text-center">
                    {{ $item->id }}
                </div>

                <a href="{{$item->speciality->edit ?? '#'}}" target="_blank" class="underline hover:text-base-red">
                        @if($item->speciality)
                            {!! $item->speciality->name !!}
                            {!! $item->speciality->name_profile !!}
                       @endif
                </a>

                <span>
                    {{ $item->FormatedPrice }}
                </span>
            </div>
        @endforeach
    </div>

@endsection

