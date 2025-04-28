@if($category->publicDocuments->count())
    <h3 class="mt-2 -mb-2 text-xl font-semibold">
        {!! $category->name !!}
    </h3>

    <div class="bg-white p-4">
        <ul>
            @each("documents.public.item",$category->publicDocuments,'document')
        </ul>
    </div>
@endif
