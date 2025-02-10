<x-admin.structure.header/>
@foreach($list as $department)
    <x-admin.structure.department
        :department="$department"
    />
@endforeach
