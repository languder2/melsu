@props([
    'staffs' => collect(),
])
@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ: Кадровый состав"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'staffs',null)}}
@endsection

@section('aside')
    {{view('public.menu.aside-tree',['menu' => $menu ?? null ])}}
@endsection


@section('content')
    @include('public.staffs.staffs.search')

    <div id="PersonnelStructure">
        <div class="flex flex-col gap-4">
            @forelse($staffs as $staff)

                @if($staff->show_this_card)
                    <div class="group bg-white p-6 flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
                        <a
                            href="{{ $staff->link }}"
                            class="flex gap-4"
                        >
                            @component('staffs.public.staff-line',['staff' => $staff,'isLink'=>true])@endcomponent
                        </a>
                    </div>
                @else
                    <div class="bg-white p-6 flex flex-col justify-between mb-3 last:mb-0">
                        <div
                            class="flex gap-4"
                        >
                            @component('staffs.public.staff-line',['staff' => $staff,'isLink'=>true])@endcomponent
                        </div>
                    </div>
                @endif

            @empty
                <div class="py-2">
                    Результатов не найдено
                </div>
            @endforelse

            {{ $staffs->links() }}
        </div>
    </div>
@endsection



