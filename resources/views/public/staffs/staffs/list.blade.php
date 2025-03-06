<div class="flex flex-col gap-4">
    @forelse($staffs as $staff)
            @if($staff->show_this_card)
                <div class="group bg-white p-6 flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
                    <a
                        href="{{url($staff->link)}}"
                        class="flex gap-4"
                    >
                        @include('public.staffs.staffs.staff',['link'=>true])
                    </a>
                </div>
            @else
                <div class="bg-white p-6 flex flex-col justify-between mb-3 last:mb-0">
                    <div
                        class="flex gap-4"
                    >
                        @include('public.staffs.staffs.staff',['link'=>false])
                    </div>
                </div>
            @endif
    @empty
        <div class="py-2">
            Результатов не найдено
        </div>
    @endforelse

    {{$staffs->links()}}
</div>
