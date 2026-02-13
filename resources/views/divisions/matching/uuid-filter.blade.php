@props([
    'filters'           => collect(Session::get('divisionMatchingUUIDFilter')),
])

<form
    action="{{ route('division.matching.uuid.filter') }}"
    method="POST"
    class="flex gap-3"
    enctype="multipart/form-data"
>
    @csrf
    <div class="p-3 bg-white shadow flex-1">
        <x-form.checkbox.block
            id="notEmptyUUID"
            name="notEmptyUUID"
            :default="0"
            :value="1"
            label="Вывести подразделения, c присвоенным UUID"
            :checked=" $filters->has('notEmptyUUID') ? $filters->get('notEmptyUUID') : true"
            block="pe-2"
        />
    </div>
    <div class="p-3 bg-white shadow flex-1">
        <x-form.checkbox.block
            id="showDisbanded"
            name="showDisbanded"
            :default="0"
            :value="1"
            label="Показывать расформированные в 1С подразделения"
            :checked=" $filters->has('showDisbanded') ? $filters->get('showDisbanded') : true"
            block="pe-2"
        />
    </div>
    <div class="p-3 bg-white shadow flex-1">
        <x-form.checkbox.block
            id="showDeleted"
            name="showDeleted"
            :default="0"
            :value="1"
            label="Показывать удаленные в 1С подразделения"
            :checked=" $filters->has('showDeleted') ? $filters->get('showDeleted') : true"
            block="pe-2"
        />
    </div>

    <div class="gap-3 p-3 bg-white shadow flex items-center">
        <x-html.submit :text="__('labels.Apply')" class="order-2"/>
        <x-html.submit :text="__('labels.Clear')" name="clear" class="order-1" />
    </div>
</form>
