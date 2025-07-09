<div class="flex gap-4 p-4 items-center">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        Информация о направлениях и результатах научной (научно-исследовательской) деятельности
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

<form action="{{ route('education-profile.nir.save',$profile) }}"
      method="POST"
      enctype="multipart/form-data"
      class="p-4 pt-0 flex flex-col gap-2"
>
    @csrf


    <x-form.textarea
        id="form-perechenNir"
        name="info[perechenNir]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        placeholder="Перечень научных направлений, в рамках которых ведется научная (научно-исследовательская) деятельность"
        value="{!! $info->perechenNir !!}"
    />

    <x-form.textarea
        id="form-napravNir"
        name="info[napravNir]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        placeholder="Название научного направления/научной школы"
        value="{!! $info->napravNir !!}"
    />

    <x-form.textarea
        id="form-resultNir"
        name="info[resultNir]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        placeholder="Результаты научной (научно-исследовательской) деятельности"
        value="{!! $info->resultNir !!}"
    />

    <x-form.textarea
        id="form-baseNir"
        name="info[baseNir]"
        class="w-full h-20 border resize-y p-2 outline-0 focus:border-blue"
        placeholder="Сведения о научно-исследовательской базе для осуществления научной (научно-исследовательской) деятельности"
        value="{!! $info->baseNir !!}"
    />


    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent
</form>
