<x-head.tinymce-config/>
<form
    action="{{ $gallery->UploadImages }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    <div class="max-w-1200 mx-auto flex gap-4 bg-white p-4">

        <div class="flex-1">
            <x-form.file
                id="images"
                label="Файлы"
                name="images[]"
                multiple
            />
        </div>

        @component('components.form.submit',[
            'name'          => 'save',
            'class'         => "uppercase",
            'value'         => "сохранить",
            'position'      => 'text-center'
        ])@endcomponent
    </div>

</form>
