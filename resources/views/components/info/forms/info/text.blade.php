<div class="flex gap-4 p-4 items-start">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        {{ __("info.{$type}.{$code}") }}
    </div>
    <a
        href="javascript:Modal.closeModal()"
        class="
            inline-block p-1 bg-red hover:bg-red-700 rounded-xl
        "
    >
        <x-info.forms.icons.close width="24px" height="24px" />
    </a>
</div>
<form action="{{route('info:save',[$type,$code,$item->id])}}" method="POST" class="p-4 pt-0 flex flex-col gap-2">
    @csrf

    <textarea name="content" class="w-full border p-2 min-h-40"
        placeholder="Текст / значение"
    >{!! $item->content !!}</textarea>

    <x-form.input
        id="form-sort"
        type="number"
        name="sort"
        label="Порядок вывода"
        value="{!! $item->sort  !!}"
    />

    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent

</form>
