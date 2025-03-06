@php $found = false @endphp

@if($department->chief)
    @include('public.departments.staff',['staff' => $department->chief->card,'post' => $department->chief->post])
@endif

@if($department->staffs->count())
    @foreach($department->staffs as $staff)
        @if($staff->card->departments->count())
            @php $found = true @endphp
            @include('public.departments.staff',['staff' => $staff->card,'post'  => $staff->post])
        @endif
    @endforeach
@endif

@if(!$found)
    <div class="bg-white p-4">
        <div
            class="
                border border-l-red-700 border-l-4 p-4 text-base-red
            "
        >
            Результаты не найдены
        </div>
    </div>
@endif
