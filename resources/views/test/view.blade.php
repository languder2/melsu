@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="flex gap-4 flex-wrap">
        @foreach($gallery->adminImages() as $image)
            <img src="{{ $image->thumbnail }}" alt="{!! $image->name !!}" />
        @endforeach
    </div>

@endsection

