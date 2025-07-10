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
        id="form-subs-addressCab"
        name="subs[addressCab]"
        :label="$cases->get('addressCab')"
        value="{!! $info->getSubsValue('addressCab') !!}"
    />

    <x-form.input
        id="form-subs-nameCab"
        name="subs[nameCab]"
        :label="$cases->get('nameCab')"
        value="{!! $info->getSubsValue('nameCab') !!}"
    />

    <x-form.textarea
        id="form-subs-osnCab"
        name="subs[osnCab]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        :placeholder="$cases->get('osnCab')"
        value="{!! $info->getSubsValue('osnCab') !!}"
    />

    <x-form.textarea
        id="form-subs-ovzCab"
        name="subs[ovzCab]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        :placeholder="$cases->get('ovzCab')"
        value="{!! $info->getSubsValue('ovzCab') !!}"
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
