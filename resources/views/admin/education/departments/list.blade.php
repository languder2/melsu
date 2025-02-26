@foreach($faculties as $faculty)
    {{ view('admin/education/departments/list-block',[
        'faculty'   => $faculty,
        'list'      => $faculty->departments,
    ]) }}
@endforeach

@if($departments->count())
    {{
        view('admin/education/departments/list-block',[
            'faculty'   => null,
            'list'      => $departments,
        ])
    }}
@endif
