@if($department->chief)
    {{
        view('Public.Departments.Staff',[
            'staff' => $department->chief->card,
            'post'  => $department->chief->post,
        ])
    }}
@endif

@if($department->staffs->count())
    @foreach($department->staffs as $staff)
        {{
            view('Public.Departments.Staff',[
                'staff' => $staff->card,
                'post'  => $staff->post,
            ])
        }}
    @endforeach
@endif
