@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content-without-bg')

    <div class="mx-5 my-3">
        <div class="font-unbounded text-base">Куда доставить</div>
        <div class="flex w-auto h-auto  p-3 bg-zinc-300 gap-3 rounded-lg">
            <img class="" src="img/input_geo.svg"/>
            <input class="placeholder:text-white placeholder:bg-zinc-300 border-none border-zinc-300 outline-none flex-1" type="text" placeholder="Введите...">
        </div>
    </div>
@endsection
