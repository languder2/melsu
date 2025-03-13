<div class="my-2">
    <div class="flex gap-3">
        <span class="text-base-red/75">
            {!! $contact->type->getIco() !!}
        </span>
        {{$contact->title ?? "Адрес"}}
    </div>
    <div>
        {{$contact->content}}
    </div>
</div>
