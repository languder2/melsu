@props([
    'pages'     => collect(),
    'size'      => null,
    'extension' => null
])
@extends("layouts.cabinet")

@section('title', __('common.Cabinet').' → '.__('common.Finance') .' → '. __('common.Compilation of the code') )

@section('content-header')
    <div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow font-semibold">
        {{ __('common.Compilation of the code') }}
    </div>
@endsection

@section('content')
    <div class="flex flex-col gap-3">

        @include('finance.cabinet.form')

        @if($pages->isNotEmpty())
            <x-common.private-attaches
                :size="$size"
                :extension="$extension"
                :link="route('finance.compilation.download')"
            >
                Файл обработан и доступен для скачивания
            </x-common.private-attaches>
        @endif

        @if($pages->isNotEmpty())

            123


        @endif
    </div>
@endsection
