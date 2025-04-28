@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
        {!! Breadcrumbs::view("vendor.breadcrumbs.base",'regiment',$type) !!}
@endsection

@section('aside')
    @include('regiment.public.menu')
@endsection

@section('content')

<div class="flex flex-col gap-6">

    @include('regiment.public.introduction')

    @include('regiment.public.filter')

    @include('regiment.public.top-menu')

    <div class="flex flex-col gap-4">
        @foreach($list as $member)
            <div data-letter="{{$member->letter}}"
                 class='accordion-item regiment-member p-4 bg-white border-b border-b-base-red'
            >
                <h3  id="member-{{$member->id}}" class="accordion-header flex gap-4 justify-between items-center group cursor-pointer"
                    onclick="Accordion(this)"
                >
                    <span class="font-semibold text-lg group-hover:text-red-700 group-hover:ms-2 transition-all duration-200">
                        {{$member->full_name}}
                    </span>
                    <svg class='text-base-red transition duration-500 group-hover:text-red-700 group-open:rotate-180'
                         width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358
                            10.2525 13.0025 9.58579 12.3358L5.5 8.25' stroke='currentColor' stroke-width='1.6'
                              stroke-linecap='round' stroke-linejoin='round'>
                        </path>
                    </svg>
                </h3>
                <div class="accordion-content h-0 overflow-hidden transition-all duration-500">
                    <div class="pt-4 text">
                        <img src="{{$member->image->src}}" alt="{{$member->full_name}}" class="w-full mb-4">
                        {!! $member->content !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


