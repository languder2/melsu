@props([
    'categories'            => collect(),
    'noDocumentsMessage'    => false,

])

@if($categories->map(fn($item) => $item->publicDocuments()->count())->sum())

    @component('documents.public.search') @endcomponent

    <div class="flex flex-col gap-4">
        @foreach($categories as $category)
            @continue($category->publicDocuments()->isEmpty())
            @if(Cache::has("documents-category-{$category->id}"))
                {!! Cache::get("documents-category-{$category->id}") !!}
            @else
                @component('documents.public.category', compact('category')) @endcomponent
            @endif
        @endforeach
        <div class="message-not-results-categories hidden">
            <div class="flex items-center bg-white shadow-sm text-base-red justify-center font-semibold p-3">
                {{ __('messages.search documents not result') }}
            </div>
        </div>
    </div>
@elseif($noDocumentsMessage)
    <div class="message-not-results-categories">
        <div class="flex items-center bg-white shadow-sm text-base-red justify-center font-semibold p-3">
            {{ __('messages.no documents') }}
        </div>
    </div>
@endif
