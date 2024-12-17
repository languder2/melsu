@foreach($list as $department)
    <x-admin.structure.department
        :department="$department"
    />
@endforeach
