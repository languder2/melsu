@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    <select>
        @foreach(\App\Enums\Staff\EducationType::Education->cases() as $case)
           <option value="{{ $case->name }}">{{ $case->label() }}</option>
        @endforeach
    </select>

@endsection

