<x-department.staff.rectorate
    :staff="$department->chief_card"
/>

@foreach($department->staffs as $staff)
    <x-department.staff.rectorate
        :staff="$staff->card"
        :post="$staff->post"
    />
@endforeach
