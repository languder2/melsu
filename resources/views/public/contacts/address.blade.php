<div class="my-3">
    <div class="flex gap-3">
        {!! $contact->type->getIco() !!}
        {{$contact->title ?? "Адрес"}}
    </div>
    <div>
        {{$contact->content}}
    </div>
</div>
