@extends("layouts.education-division")

@section('title')
    {{ $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»: $division->name" }}
@endsection

@section('additional-header')
    @component('divisions.education.public.sections.header', compact('division')) @endcomponent
@endsection

@section('content')
    <div class="grid lg:grid-cols-[2fr_1fr] xl:grid-cols-[75%_auto] gap-5 px-2.5 2xl:px-0 mb-6">
        <div class="flex flex-col gap-3">
            <h2 class="font-bold text-xl md:text-3xl mb-4">
                {{ __('menu.documents') }}
            </h2>

            @if($division->publicDocuments->isNotEmpty())
                @component('documents.public.categories',['categories' => $division->publicDocumentCategories]) @endcomponent
            @else
                <div class="message-not-results-categories">
                    <div class="flex items-center bg-white shadow-sm text-base-red justify-center font-semibold p-3">
                        {{ __('messages.no documents') }}
                    </div>
                </div>
            @endif
        </div>

        <div class="order-1 lg:order-2 flex flex-col gap-5">
            @component('divisions.education.public.sections.menu', compact('division')) @endcomponent
        </div>
    </div>

@endsection



