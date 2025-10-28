@extends("layouts.cabinet")

@section('title', 'Новости')

@section('content')

    <div class="grid grid-cols-[auto_1fr_auto_auto] gap-px">
        <div class="grid grid-cols-subgrid col-span-4 bg-slate-700 sticky top-0 text-white">
            <div class="p-3">
                id
            </div>
            <div class="p-3 border-l border-white">
                Подразделение
            </div>
            <div class="p-3 border-l border-white"></div>
            <div class="p-3 border-l border-white"></div>
        </div>


        @forelse($list as $division)

            <div class="grid grid-cols-subgrid col-span-4 odd:bg-slate-200">

                <div class="p-3 flex items-center justify-center">
                    {!! $division->id !!}
                </div>

                <div class="p-3 flex gap-3 items-center border-l border-white">

                    @for($i=1; $i <= $division->level; $i++)
                        <span class="px-1"></span>
                    @endfor

                    @if($division->level)
                        <x-lucide-corner-down-right class="w-4" />
                    @endif

                    {!! $division->name !!}
                </div>

                <div class="flex gap-3 p-3 border-l border-white items-center">
                    <a href="{{ $division->link }}" target="_blank" class="flex-end hover:text-green-700">
                        <x-lucide-square-arrow-out-up-right class="w-6"/>
                    </a>
                </div>
                <div class="flex gap-3 p-3 ps-6 border-l border-white">
                    <div class="flex items-center justify-center">
                        <a href="{{ $division->cabinet_form }}" class="hover:text-amber-500">
                            <x-lucide-layout-template class="w-6" />
                        </a>
                    </div>

                    <div class="p-3">
                        <form action="{{ route('news.cabinet.set-filter') }}" method="post">
                            @csrf
                            <input type="hidden" name="setFilter[division]" value="{{ $division->id }}">
                            <label>
                                <x-lucide-notepad-text class="w-6 hover:text-amber-500 cursor-pointer"/>
                                <input type="submit" class="hidden">
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center font-semibold p-3 text-red-800">
                Нет доступных Вам подразделений.
            </div>
        @endforelse
    </div>
@endsection
