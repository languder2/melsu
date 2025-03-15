<div class="my-2">
    <div class="flex gap-3 mb-1 items-center">
        <span class="text-base-red/75">
            {!! $contact->type->getIco() !!}
        </span>
        <span class="font-semibold">
            {{$contact->title ?? "Адрес"}}
        </span>
    </div>
    <div>
        {{$contact->content}}
    </div>
</div>
