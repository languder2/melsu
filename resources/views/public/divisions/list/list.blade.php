@php $found = false @endphp

@if($division->chief)
    @include('public.divisions.list.staff',['staff' => $division->chief->card,'post' => $division->chief->post])
@endif

@if($division->staffs->count())
    @foreach($division->staffs as $staff)
        @if($staff->card->divisions->count())
            @php $found = true @endphp
            @include('public.divisions.list.staff',['staff' => $staff->card,'post'  => $staff->post])
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
