@props([
    'categories'  => collect()
])

<div class="flex flex-col gap-4">
    @foreach($categories as $category)
        <h3 class="text-2xl font-semibold lowercase first-letter:uppercase">
            {{ $category->name }}
        </h3>

        @foreach($category->publicDocuments() as $document)
            <x-common.attaches :document="$document" />

            @foreach($document->subs as $sub)
                <x-common.attaches :document="$sub" />
            @endforeach
        @endforeach


        @dump($category->publicDocuments())

    @endforeach
</div>
