<h3
    class="
        font-semibold
        text-2xl
        mb-3
    "
>
    Ректорат
</h3>
<x-department.staff.rectorate
    :staff="$department->chief_card"
/>

@foreach($department->staffs as $staff)
    <x-department.staff.rectorate
        :staff="$staff->card"
        :post="$staff->post"
    />
@endforeach
