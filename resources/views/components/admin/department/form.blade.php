<x-head.tinymce-config />

<form
    action="{{route('admin:staff:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
        max-w-[1200px]
        min-w-[800px]
        mx-auto
    "
>
    @csrf

    <x-admin.department.form.base :current="$current??(object)[]" />

    <x-admin.department.form.sections :current="$current??(object)[]" />

</form>
