{{
    view('Public.Departments.Staff',[
        'staff' => $department->chief->card,
        'post'  => $department->chief->post,
    ])
}}

@foreach($department->staffs as $staff)
    {{
        view('Public.Departments.Staff',[
            'staff' => $staff->card,
            'post'  => $staff->post,
        ])
    }}
@endforeach

