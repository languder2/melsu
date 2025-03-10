@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content-without-bg')

    <x-admin.contact.list-of-types-for-add />

    <x-admin.contact.form type="telegram"/>

@endsection
