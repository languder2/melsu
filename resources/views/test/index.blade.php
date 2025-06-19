@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="grid grid-cols-[auto_auto_auto] gap-4 ">
        @foreach($list as $item)
            <div>
                {{ $item->id }}
            </div>
            <div class="flex flex-col gap-2">
                {{ $item->name }}
                {{ $item->name_profile }}
            </div>
            <div>
                {{ (int) $item->show}}
                {{ (int) $item->is_recruitment }}
            </div>
        @endforeach
    </div>

@endsection

