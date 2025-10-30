@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    {!! $event->content_html !!}

    {!! $news->content_html !!}
@endsection

