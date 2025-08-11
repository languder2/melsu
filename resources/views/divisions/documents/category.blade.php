<h3 class="pt-2 pb-4">
    {{ $category->name_with_parents }}
</h3>
<div class="text-center p-4 bg-white">
    @dump($category->relation_document_add)
</div>
@foreach($category->subs as $category)
    @component('divisions.documents.category',compact('category')) @endcomponent
@endforeach
