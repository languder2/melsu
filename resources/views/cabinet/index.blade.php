@extends("layouts.cabinet")

@section('title', __('common.melsu') . __('common.arrowR') . __('common.office') )

@section('content')

    <div class="flex gap-3 flex-wrap">

        <x-cabinet.sections.index-link
            lucide="notebook-text"
            color="text-green-950"
            text="Новости"
            :link=" route('news.cabinet.list') "
        />

        <x-cabinet.sections.index-link
            lucide="notebook-text"
            color="text-red-950"
            text="Новости на утверждении"
            :link=" route('news.cabinet.onApproval') "
        />

        <x-cabinet.sections.index-link
            lucide="university"
            color="text-blue-950"
            text="Подразделения"
            :link=" route('divisions.cabinet.list') "
        />

        <x-cabinet.sections.index-link
            lucide="panels-top-left"
            color="text-blue-950"
            text="Страницы"
            :link=" route('divisions.cabinet.list') "
        />
    </div>
@endsection
