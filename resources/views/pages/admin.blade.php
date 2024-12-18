@extends('layouts.admin')

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    @if(is_array(@$contents))
        @foreach($contents as $content)
            {!! $content !!}
        @endforeach

    @endif

@endsection

