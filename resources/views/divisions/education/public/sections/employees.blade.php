@props([
    'division'      => new \App\Models\Division\Division(),
    'list'          => collect(),
    'title'         => null,
])

@if($staffs->count())
    @if($title)
        <h3 class="font-semibold text-xl md:text-2xl">
            {{ $title }}
        </h3>
    @endif
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-x-4 gap-y-6">
        @foreach($staffs as $staff)
            @component('public.staffs.division.staff',[
                'staff'         => $staff,
                'full_post'     => $full_post ?? null,
            ])@endcomponent
        @endforeach

    </div>

@endif
