@extends("layouts.cabinet")

@section('title', __('common.Cabinet') . " → " . __('common.Divisions') . " → " . ( $division->exists ? $division->name : __('common.New') )  )

@section('content')

@endsection
