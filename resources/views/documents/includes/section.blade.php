<div
    id="{{ $slot }}"
    @class([
        "form_box",
        (old('side_menu') === $slot || isset($active))?'':'hidden'
    ])
>
    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Документы
        </div>

        <a
            href="{{route('documents:api:add-block')}}"
            onclick="Actions.addSection(document.querySelector('.documents'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить документ
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="documents mt-4 flex flex-col gap-4">
        @foreach($list as $item)
            @component('documents.includes.block',[
                'item'      => $item
            ])
            @endcomponent
        @endforeach
{{--            @component('documents.includes.block',[--}}
{{--                'item'      => new \App\Models\Documents\Document()--}}
{{--            ])--}}
{{--            @endcomponent--}}


    </div>


    <div class="flex gap-4 items-center bg-white p-4 mt-4">
        <div class="flex-1 text-lg font-semibold">
        </div>
        <a
            href="{{route('documents:api:add-block')}}"
            onclick="Actions.addSection(document.querySelector('.documents'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить документ
            </x-form.button.base-admin>
        </a>
    </div>
</div>
