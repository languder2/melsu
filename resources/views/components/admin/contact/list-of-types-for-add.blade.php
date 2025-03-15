<div class="flex gap-3">
    @foreach($types as $type)
        <a
            href="{{route('api:admin:contact:add-position',[$type])}}"

            onclick="Actions.addSection(document.querySelector('.contact-list'),this.href,true); return false;"

            class="
                bg-slate-800 hover:bg-green-700 rounded-md
                py-2 px-3
                text-white stroke-white
                flex items-center
            "
            title="Добавить контакт: {{$type->getName()}}"
        >
            {!! $type->getIco() !!}
        </a>
    @endforeach
</div>
