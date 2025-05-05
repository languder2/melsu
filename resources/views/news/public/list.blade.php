@extends("layouts.main")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет": Новости')

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base",'news',null)!!}
@endsection

@section('includes')
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="{{asset('js/jquery-data-picker.js')}}"></script>
@endsection

@section('content')
    @component('components.news.all',[
        'list' => $list,
        'categories'    => $categories,
        'category'      => $category,
        'search'      => $search
    ])@endcomponent
@endsection
