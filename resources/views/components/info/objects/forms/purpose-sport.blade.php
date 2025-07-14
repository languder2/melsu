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

<form action="{{ route($info::routeNameSave,[$code,$info->exists ? $info->id : null]) }}" method="POST" class="p-4 pt-0 flex flex-col gap-2">
    @csrf
    <x-form.input
        id="form-subs-objName"
        name="subs[objName]"
        :label="$cases->get('objName')"
        value="{!! $info->getSubsValue('objName') !!}"
    />

    <x-form.input
        id="form-subs-objAddress"
        name="subs[objAddress]"
        :label="$cases->get('objAddress')"
        value="{!! $info->getSubsValue('objAddress') !!}"
    />

    <x-form.input
        id="form-subs-objSq"
        name="subs[objSq]"
        type="number"
        step="0.1"
        :label="$cases->get('objSq')"
        value="{!! $info->getSubsValue('objSq') !!}"
    />
    <x-form.input
        id="form-subs-objCnt"
        name="subs[objCnt]"
        type="number"
        step="1"
        :label="$cases->get('objCnt')"
        value="{!! $info->getSubsValue('objCnt') !!}"
    />

    <x-form.textarea
        id="form-subs-objOvz"
        name="subs[objOvz]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        :placeholder="$cases->get('objOvz')"
        value="{!! $info->getSubsValue('objOvz') !!}"
    />

    <x-form.input
        id="form-sort"
        type="number"
        name="sort"
        label="Порядок вывода"
        value="{!! $info->sort  !!}"
    />

    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent

</form>
