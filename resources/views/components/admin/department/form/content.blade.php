<div id="department-section-{{$i}}" data-ident="department-section" data-ordinal="{{$i}}">
    <div class="flex my-2 py-2 border-b border-t items-center">

        <h4 class="text-center font-semibold flex-1">
            <a href="#"
               class="
                    showHideSection
                    text-blue-900
                    hover:text-blue-700
                    active:text-gray-700
                    underline
                "
               data-id='department-section-{{$i}}'
            >
                Секция #{{$i}}
            </a>

        </h4>

        <div>
            <button
                class="
                    block
                    py-2 px-4
                    rounded-md
                    text-white
                    bg-red-900 hover:bg-red-700 active:bg-red-700
                    removeBlock
                "
                data-ident='department-section'
                data-ordinal="{{$i}}"
            >
                удалить секцию
            </button>
        </div>

    </div>

    <div class="wrapper transition-all duration-400 overflow-hidden max-h-[1000px]">
        <x-form.input
            id="sections_{{$i}}_name"
            name="sections[{{$i}}][name]"
            label="Название секции (секция без названия удаляется)"
            value="{{old('sections.'.$i.'.name')??@$current->name}}"
        />

        <x-form.input
            id="sections_{{$i}}_sort"
            type="numeric"
            name="sections[{{$i}}][sort]"
            label="Порядок вывода (числовое, если не указано - будет установлен автоматически)"
            value="{{old('sections.'.$i.'.sort')??@$current->sort}}"
        />

        <x-form.checkbox
            id="sections_{{$i}}_hide"
            name="sections[{{$i}}][hide]"
            text="Скрыть заголовок"
            checked
        />

        <x-form.editor
            id="sections_{{$i}}_text"
            name="sections[{{$i}}][text]"
            label="Контент секции"
            value="{{old('sections.'.$i.'.text')??@$current->text}}"
            hideLabel
        />
    </div>
</div>
