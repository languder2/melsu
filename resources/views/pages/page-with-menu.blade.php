@extends("layouts.page")

@section('title', $title??'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {!! @$breadcrumbs !!}
@endsection

@section('sidebar')
    {!! @$sidebar !!}
@endsection

@section('content')
    @if(is_array(@$contents))
        @foreach($contents as $content)
            {!! $content !!}
        @endforeach
    @endif
@endsection

