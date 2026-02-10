@props([
    'categories'  => collect()
])

@if($categories->map(fn($item) => $item->publicDocuments()->count())->sum())

    @component('documents.public.search') @endcomponent

    <div class="flex flex-col gap-4">
        @foreach($categories as $category)
            @continue($category->publicDocuments()->isEmpty())

            <input
                id="category{{ $category->id }}"
                value="showDocumentCategory{{ $category->id }}"
                type="checkbox"
                class="hidden showDocumentCategory"
                @checked($category->option('show_documents')->property == 1 || !$category->option('show_documents')->exists)
            >

            <div class="text-white flex gap-px">
                <label for="category{{ $category->id }}" class="cursor-pointer flex-1 grid grid-cols-[1fr_24px] gap-3 items-center select-none hover:bg-hover-red p-3 ps-6 bg-base-red">
                    <span
                        class="font-semibold"
                    >
                        {{ $category->name }}
                    </span>

                    <span class="text-left">
                        <x-lucide-list-chevrons-down-up
                            title="{{ __('messages.Show documents') }}"
                            class="w-6 hidden group-has-checked:block"
                        />
                        <x-lucide-list-chevrons-up-down
                            title="{{ __('messages.Hide documents') }}"
                            class="w-6 block group-has-checked:hidden"
                        />
                    </span>
                </label>
                <div
                    class="
                        p-3
                        bg-neutral-800
                        group-has-checked:bg-base-red
                        group-has-checked:cursor-pointer
                        group-has-checked:hover:bg-hover-red
                        {{ $category->publicDocuments()->count() < 5 ? 'hidden' : 'flex items-center'  }}
                        search-btn
                        group


                    "
                >
                    <x-lucide-search class="w-6 block group-open:hidden" />
                    <x-lucide-x class="w-6 hidden group-open:block"  />
                </div>
            </div>

            <div
                data-category="{{ $category->id }}"
                data-accordion="{{$category->option('accordion_prefix')->property}}"
                class="
                    category-documents
                    @if($category->option('show_documents')->property != 1 && $category->option('show_documents')->exists) hidden @endif
                "
            >
                <div class="flex flex-col gap-3">
                    <div class="documents-search-box hidden bg-white shadow p-3 ps-7 pe-4">
                        <div class="flex gap-3">
                            <input type="text" class="py-1 outline-0 border-b-1 w-full">

                            <x-lucide-x class="w-6 cursor-pointer hover:text-hover-red search-clear" />
                        </div>
                    </div>

                    @if($category->content('short')->exists)
                        {!! $category->content('short')->render() !!}
                    @endif

                    @foreach($category->publicDocuments() as $document)
                        <div class="flex flex-col gap-2 document">
                            <x-common.attaches :document="$document" />

                            @foreach($document->subs as $sub)
                                <x-common.attaches :document="$sub" />
                            @endforeach
                        </div>
                    @endforeach
                    <div class="message-not-results-documents hidden">
                        <div class="flex items-center bg-white shadow-sm text-base-red justify-center font-semibold p-3">
                            {{ __('messages.search documents not result') }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
    <div class="message-not-results-categories hidden">
        <div class="flex items-center bg-white shadow-sm text-base-red justify-center font-semibold p-3">
            {{ __('messages.search documents not result') }}
        </div>
    </div>
    </div>
@endif
