@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content')

    <div class="grid grid-cols-[auto_1fr_auto] gap-px">
        <div class="p-3 bg-slate-700 text-white sticky top-0">
            id
        </div>
        <div class="p-3 bg-slate-700 text-white sticky top-0">
            Подразделение
        </div>
        <div class="p-3 bg-slate-700 text-white sticky top-0"></div>

        @for($i=0; $i<10; $i++)
            @forelse($list as $division)
                <div class="p-3 {{ $loop->iteration % 2 ? "bg-slate-200" : "" }}">
                    {!! $division->id !!}
                </div>
                <div class="p-3 {{ $loop->iteration % 2 ? "bg-slate-200" : "" }}">
                    {!! $division->name !!}
                </div>
                <div class="p-3 {{ $loop->iteration % 2 ? "bg-slate-200" : "" }}">

                    <form action="{{ route('news.cabinet.set-filter') }}" method="post">
                        @csrf
                        <input type="hidden" name="setFilter[division]" value="{{ $division->id }}">
                        <label>
                            <x-lucide-notepad-text class="w-6 hover:text-slate-500 cursor-pointer"/>
                            <input type="submit" class="hidden">
                        </label>
                    </form>
                </div>
            @empty

            @endforelse
        @endfor
    </div>

@endsection
