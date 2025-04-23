@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="max-w-1200 mx-auto p-6 bg-white flex gap-4">
        <img
            src="https://melsu.ru/img/staff/Rogozin.jpg"
             alt="Рогозин Дмитрий Олегович"
             class="h-60"
        />

        <div class="flex flex-col gap-3">
            <div class="text-red-700 text-md font-bold -mb-2">
                Председатель Попечительского совета:
            </div>
            <div class="font-semibold text-lg">
                Рогозин Дмитрий Олегович
            </div>
            <div class="">
                Сенатор России,
            </div>
            <div class="">
                Представитель от исполнительного органа,<br>
                государственной власти Запорожской области<br>
                в Совете Федерации
            </div>
            <div class="flex-grow-1"></div>
            <div class="underline hover:text-red-700">
                <a href="">подробнее..</a>
            </div>
        </div>
    </div>

@endsection

