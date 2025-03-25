<div
    id="tab_faq"
    @class([
        "form_box",
        (old('side_menu') === 'tab_faq' || isset($active))?'':'hidden'
    ])
>

    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Вопросы и ответы
        </div>
        <a
            href="{{route('api:faq:add')}}"
            onclick="Actions.addSection(document.querySelector('.faq'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить вопрос
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="faq">
        @if(old('_token'))
            @foreach(old('faq') ?? [] as $id=>$faq)
                @component('admin.faq.block',[
                        'faq'       => (object)$faq,
                        'id'        => $id,
                        'answer'    => isset($faq['answer'])
                ]) @endcomponent
            @endforeach
        @elseif($current)
            @foreach($current->faq as $faq)
                @component('admin.faq.block',[
                        'faq'       => $faq,
                        'id'        => $faq->id,
                ]) @endcomponent
            @endforeach
        @endif
    </div>

    <div class="flex gap-4 items-center bg-white p-4 mt-4">
        <div class="flex-1 text-lg font-semibold">
        </div>
        <a
            href="{{route('api:faq:add')}}"
            onclick="Actions.addSection(document.querySelector('.faq'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить вопрос
            </x-form.button.base-admin>
        </a>
    </div>
</div>


