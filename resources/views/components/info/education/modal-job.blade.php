<div class="flex gap-4 p-4 items-center">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        Информация о трудоустройстве выпускников для каждой реализуемой образовательной программы, по которой состоялся выпуск за 2023-2024 учебный год
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

<form action="{{ route('education-profile.job.save',$item) }}"
      method="POST"
      enctype="multipart/form-data"
      class="p-4 pt-0 flex flex-col gap-2"
>
    @csrf

    <x-form.input
        id="form-v1"
        type="number"
        name="info[v1]"
        label="Количество выпускников"
        value="{!! $info->v1 ?? null !!}"
    />

    <x-form.input
        id="form-t1"
        type="number"
        name="info[t1]"
        label="Количество трудоустроенных выпускников"
        value="{!! $info->t1 ?? null !!}"
    />

    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent
</form>
