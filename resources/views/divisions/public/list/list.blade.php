@php $found = false @endphp

@if($division->chief)
    @component('divisions.public.list.staff',['staff' => $division->chief->card,'post' => $division->chief->post]) @endcomponent
@endif

@if($division->staffs->count())
    @foreach($division->staffs as $staff)
        @if($staff->card->divisions->count())
            @php $found = true @endphp
            @component('divisions.public.list.staff',['staff' => $staff->card,'post'  => $staff->post])@endcomponent
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
