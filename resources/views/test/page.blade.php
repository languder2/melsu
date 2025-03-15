@extends("layouts.main")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    @use('App\Enums\CardBG')

    <div class="h-[800px] p-8 flex gap-8">

        <div class="w-40 h-40 {{ CardBG::getRandom() }} p-8">
        </div>
        <div class="w-40 h-40 {{ CardBG::getRandom() }} p-8">
        </div>
        <div class="w-40 h-40 {{ CardBG::getRandom() }} p-8">
        </div>
        <div class="w-40 h-40 {{ CardBG::getRandom() }} p-8">
        </div>

    </div>
@endsection
