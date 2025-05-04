@extends("layouts.admin")

@section('title', 'Админ панель: Документы')

@section('top-menu')
{{--    @include('documents.admin-menu')--}}
@endsection

@section('content-header')

@endsection

@section('content')
    <div class="flex flex-col gap-4">
        @foreach($list as $spec)
            @continue($spec->documents->isEmpty())

            <a href="{{ route('admin:speciality:edit',$spec) }}" target="_blank">
                {!! $spec->name !!}
            </a>
        @endforeach
    </div>
@endsection
