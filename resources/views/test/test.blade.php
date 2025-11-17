@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <x-events.list-by-category category="security" />

@endsection

