@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')
    Общие сведения
@endsection
@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-[500px_1fr] gap-4">
        @component('components.sveden.common')
            @slot('itemprop')
                fullName
            @endslot
            @slot('title')
                Полное наименование организации:
            @endslot
            @slot('value')
                Федеральное государственное бюджетное образовательное учреждение высшего образования «Мелитопольский государственный университет
            @endslot
        @endcomponent

        @component('components.sveden.common')
            @slot('itemprop')
                shortName
            @endslot
            @slot('title')
                Сокращенные наименования организации:
            @endslot
            @slot('value')
                МелГУ
            @endslot
        @endcomponent

        @component('components.sveden.common')
            @slot('itemprop')
                regDate
            @endslot
            @slot('title')
                Дата создания образовательной организации:
            @endslot
            @slot('value')
                27.05.2022
            @endslot
        @endcomponent

        @component('components.sveden.common')
            @slot('itemprop')
                address
            @endslot
            @slot('title')
                Адрес местонахождения образовательной организации (юридический и почтовый адрес):
            @endslot
            @slot('value')
                272312, Запорожская область, г. Мелитополь, проспект Богдана Хмельницкого, 18
            @endslot
        @endcomponent

    </div>
@endsection


