@extends("layouts.cabinet")

@section('title', __('common.melsu') . __('common.arrowR') . __('common.office') )

@section('content')
    @auth
        <div class="flex gap-3 flex-wrap">

            <x-cabinet.sections.index-link
                lucide="notebook-text"
                color="text-green-950"
                text="Новости"
                :link=" route('news.cabinet.list') "
            />

            @if(auth()->user()->isEditor() || auth()->user()->divisions->isNotEmpty())
                <x-cabinet.sections.index-link
                    lucide="university"
                    color="text-blue-950"
                    text="Подразделения"
                    :link=" route('divisions.cabinet.list') "
                />
            @endif

            @if(auth()->user()->isEditor() || auth()->user()->pages->isNotEmpty())
                <x-cabinet.sections.index-link
                    lucide="panels-top-left"
                    color="text-blue-950"
                    text="Страницы"
                    :link=" route('pages.cabinet.list') "
                />
            @endif

            <x-cabinet.sections.index-link
                lucide="chart-bar-stacked"
                color="text-red-800"
                text="Состояние заполнения"
                :link=" route('divisions.cabinet.statuses') "
            />

            @if(auth()->user()->isAdmin())
                <x-cabinet.sections.index-link
                    lucide="list-todo"
                    color="text-blue-950"
                    text="Подразделения. Соответствия UUID"
                    :link=" route('division.matching.uuid') "
                />
            @endif

            @if(auth()->user()->isFinance() || auth()->user()->isSuper())
                <x-cabinet.sections.index-link
                    lucide="receipt-russian-ruble"
                    color="text-blue-950"
                    text="Компиляция свода"
                    :link=" route('finance.compilation.index')"
                />
            @endif

            @if(auth()->user()->isEditor() || auth()->user()->isAdmin() || auth()->user()->isSuper())
                <x-cabinet.sections.index-link
                    lucide="files"
                    color="text-blue-950"
                    :text=" __('common.Documents') "
                    :link=" route('documents.cabinet.list')"
                />
            @endif

        </div>
    @endauth
@endsection
