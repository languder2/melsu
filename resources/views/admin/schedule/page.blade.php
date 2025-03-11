@extends('layouts.admin')

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    <div class="text-center">
        <form action="{{ route('schedule.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="border border-gray-50 p-2 bg-white cursor-pointer hover:bg-gray-100 hover:border-gray-100 transition duration-300 ease-linear">
            <button type="submit" class="bg-green-600 p-2 border border-green-600 text-white hover:bg-green-700 hover:border-green-700 cursor-pointer transition duration-300 ease-linear">Загрузить</button>
            @if (session('success'))
                <div class="alert alert-success text-green-700 mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>
@endsection

