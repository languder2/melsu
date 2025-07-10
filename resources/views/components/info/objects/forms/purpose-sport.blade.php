<div class="flex gap-4 p-4 items-center">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        {{ $case->label() }}
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

<form action="{{ $info->save ?? "#" }}" method="POST" class="p-4 pt-0 flex flex-col gap-2">
@csrf

{{--    <input type="hidden" name="code" value="{{ $code }}">--}}

{{--    @foreach($info::Fields as $field)--}}
{{--        <x-form.input--}}
{{--            id="form-{{ $field->name }}"--}}
{{--            name="{{ $field->name }}"--}}
{{--            label="{!! $field->label() !!}"--}}
{{--            value="{!! $info->getSubsValue($field->name)  !!}"--}}
{{--        />--}}
{{--    @endforeach--}}

{{--    <x-form.input--}}
{{--        id="form-sort"--}}
{{--        type="number"--}}
{{--        name="sort"--}}
{{--        label="Порядок вывода"--}}
{{--        value="{!! $info->sort  !!}"--}}
{{--    />--}}

    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent

</form>
