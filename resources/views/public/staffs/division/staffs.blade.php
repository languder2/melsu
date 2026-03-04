@props([
    'staffs' => collect()
])

@if($staffs->count())
    <h4 class="font-semibold py-4 text-xl">
        {{ $title }}
    </h4>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-x-3 gap-y-4">
{{--        @foreach($staffs as $staff)--}}
{{--            @component('public.staffs.division.staff',[--}}
{{--                'staff'         => $staff,--}}
{{--                'full_post'     => $full_post ?? null,--}}
{{--            ])@endcomponent--}}
{{--        @endforeach--}}
        @each('public.staffs.division.staff',$staffs,'staff')

    </div>

@endif
