<form
    action="{{route('admin:speciality:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
            grid gap-2
            grid-cols-[250px_1fr]
        "
>
    @csrf

    <div>
        <x-admin.education.specialities.form.links/>
    </div>


    <div>
        <x-admin.education.specialities.form.body
            :current="$current"
            :add2faculty="$add2faculty"
            :faculties="$faculties"
            :departments="$departments"
            :levels="$levels"
        />
    </div>
</form>

