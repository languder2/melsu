@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

<div class="mx-20 min-h-40 flex gap-4 has-[:checked]:bg-green-700">
    <input id="check1" type="checkbox" class="peer hidden">
    <label for="check1" class="cursor-pointer peer-checked:bg-blue-700">
        checkbox
    </label>
    <div class="peer-checked:bg-red-700">
        123
    </div>
</div>


@endsection

