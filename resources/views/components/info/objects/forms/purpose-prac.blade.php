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
        id="form-subs-addressPrac"
        name="subs[addressPrac]"
        :label="$cases->get('addressPrac')"
        value="{!! $info->getSubsValue('addressPrac') !!}"
    />

    <x-form.input
        id="form-subs-namePrac"
        name="subs[namePrac]"
        :label="$cases->get('namePrac')"
        value="{!! $info->getSubsValue('namePrac') !!}"
    />

    <x-form.textarea
        id="form-subs-osnPrac"
        name="subs[osnPrac]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        :placeholder="$cases->get('osnPrac')"
        value="{!! $info->getSubsValue('osnPrac') !!}"
    />

    <x-form.textarea
        id="form-subs-ovzPrac"
        name="subs[ovzPrac]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        :placeholder="$cases->get('ovzPrac')"
        value="{!! $info->getSubsValue('ovzPrac') !!}"
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
