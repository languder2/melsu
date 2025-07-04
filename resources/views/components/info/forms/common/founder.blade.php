<div class="flex gap-4 p-4 items-center">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        {{ __("info.founder.add") }}
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
<form action="{{ $founder->save }}" method="POST" class="p-4 pt-0 flex flex-col gap-2">
    @csrf

    @foreach($founder::Fields as $field)
        <x-form.input
            id="form-{{ $field->name }}"
            name="{{ $field->name }}"
            label="{!! $field->label() !!}"
            value="{!! $founder->getSubsValue($field->name)  !!}"
        />
    @endforeach


    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent

</form>
