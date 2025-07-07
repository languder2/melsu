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
<form action="{{route('info:document:save',[$type,$code,$info->exists ? $info->id : null])}}" method="POST" enctype="multipart/form-data" class="p-4 pt-0 flex flex-col gap-2">
    @csrf

    <input type="hidden" name="document_id" value="{{ $item->document->id ?? null }}">

    <textarea
        name="content"
        class="w-full border p-2 min-h-10 resize-none"
        placeholder="Название файла"
    >{!! $info->content ?? '' !!}</textarea>

    @component('components.form.file',[
        'id'        => 'file',
        'label'     => 'Document',
        'name'      => 'file',
    ])
        @unless($info->document)
            @slot('required')
                true
            @endslot
        @endunless
    @endcomponent


    @if($info->document)
        <div class="">
            <a
                href="{{ $info->document->link }}"
                target="_blank"
                class="underline hover:text-red"
            >
                {!! $info->content !!}
            </a>
        </div>
    @endif


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
