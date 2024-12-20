<h4 class="my-2 py-2 text-center font-semibold border-b border-t">
    Секция
</h4>
<div data-ident="department-section"  data-last="{{$i}}">
    <x-form.input
        id="sections_{{$i}}_name"
        name="sections[{{$i}}][name]"
        label="Название секции"
        value="{{old('sections.'.$i.'.name')??@$curent->name}}"
    />

    <x-form.input
        id="sections_{{$i}}_sort"
        type="numeric"
        name="sections[{{$i}}][sort]"
        label="Порядок вывода (числовое, если не указано - будет установлен автоматически)"
        value="{{old('sections.'.$i.'.sort')??@$curent->sort}}"
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
        value="{{old('sections.'.$i.'.text')??@$curent->text}}"
        hideLabel
    />



</div>
