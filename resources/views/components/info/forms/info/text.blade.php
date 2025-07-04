<div class="flex gap-4 p-4">
    <div id="modal-header" class="flex-1 text-center font-semibold">
        {{ __("info.".strtolower($type).".{$code}") }}
    </div>
    <a href="javascript:Modal.closeModal()">
        close
    </a>
</div>
<form action="#" method="POST" class="p-4 pt-0 flex flex-col gap-2">
    @csrf
    <textarea class="w-full border p-2 min-h-40">{!! $item->content !!}</textarea>

        @component('components.form.submit',[
            'name'          => 'save',
            'class'         => "uppercase",
            'value'         => "сохранить",
            'position'      => "text-center",
        ])@endcomponent

</form>
