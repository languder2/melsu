@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 max-w-[1360px] mx-auto mb-6">
        <a
            href="https://melsu.ru/division/373"
            class="hover:-mt-1 hover:mb-1 hover:shadow-md duration-300 text-base-red border border-gray-200 rounded-md"
        >
            <img
                src="/storage/images/pages/career-guidance-education/The-School-of-the-Young-Genius.jpg"
                class="aspect-square rounded-t-md"
                alt
            >
            <span class="p-3 block font-semibold">
            Школа Юного Гения
        </span>
        </a>
        <a
            href="https://melsu.ru/universitetskie-subboty"
            class="hover:-mt-1 hover:mb-1 hover:shadow-md duration-300 text-base-red border border-gray-200 rounded-md"
        >
            <img
                src="/storage/images/pages/career-guidance-education/University-Saturdays.jpg"
                class="aspect-square rounded-t-md"
                alt
            >
            <span class="p-3 block font-semibold">
            Университетские субботы
        </span>
        </a>
        <a
            href="{{ url('podgotovitelnye-kursy') }}"
            class="hover:-mt-1 hover:mb-1 hover:shadow-md duration-300 text-base-red border border-gray-200 rounded-md"
        >
            <img
                src="/storage/images/pages/career-guidance-education/photo_2025-12-04_09-44-03.jpg"
                class="aspect-square rounded-t-md"
                alt
            >
            <span class="p-3 block font-semibold">
            Подготовительные курсы
        </span>
        </a>
    </div>

@endsection

