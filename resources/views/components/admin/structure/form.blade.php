<form
    action="#"
    method="POST"
    class="
        p-4 bg-white rounded-md
        max-w-[700px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text-2xl">
        Add
    </h3>

    <hr>

    <x-form.errors />


    <hr>

    <x-form.submit
        value="save"
    />

</form>
