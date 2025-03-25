<div
    id="tab_career"
    @class([
        "form_box",
        (old('side_menu') === 'tab_career' || isset($active))?'':'hidden'
    ])
>
    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Карьеры
        </div>
        <a
            href="{{route('api:career:add')}}"
            onclick="Actions.addSection(document.querySelector('.careers'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить карьеру
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="careers">
        @if(old('_token'))
            @foreach(old('career') ?? [] as $id=>$item)
                @component('admin.career.block',[
                    'item'      => (object)$item,
                ]) @endcomponent
            @endforeach
        @else
            @foreach($current->career(false)->get() as $item)
                @component('admin.career.block',[
                    'item'      => $item,
                ]) @endcomponent
            @endforeach
        @endif
    </div>

    <div class="flex gap-4 items-center bg-white p-4 mt-4">
        <div class="flex-1 text-lg font-semibold">
        </div>
        <a
            href="{{route('api:career:add')}}"
            onclick="Actions.addSection(document.querySelector('.careers'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить карьеру
            </x-form.button.base-admin>
        </a>
    </div>
</div>


