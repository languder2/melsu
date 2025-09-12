@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

<div class="grid grid-cols-[auto_1fr_auto] gap-4 mx-4">
    @forelse($list as $item)
        <div class="text-center з">
            {{ $item->id }}
        </div>
        <div>
            <a href="{{ $item->link }}" target="_blank" class="underline hover:text-red-700">
                {!! $item->name !!}
            </a>
        </div>
        <div>

        </div>
    @empty
        <div class="col-span-3 text-center font-semibold">
            Нет записей
        </div>
    @endforelse
</div>
@endsection

