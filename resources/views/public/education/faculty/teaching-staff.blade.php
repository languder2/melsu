@extends("layouts.main")

@section('title')
    ФГБОУ ВО "МелГУ: {{$division->name}}
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'faculty',$division)}}
@endsection

@section('content')

    <section class="container px-2">
        <div
            class="
                flex gap-4 mb-4
                relative
                before:absolute
                before:inset-0
                before:bg-cover before:bg-center
                before:opacity-50
            "
        >
            @isset($division->chief->card)
                <img
                    src="{{$division->chief->card->avatar->thumbnail}}"
                    alt="{{$division->chief->card->full_name}}"
                    class="w-92"
                />
            @endisset

            <div class="flex-1 flex flex-col gap-3 bg-neutral-100 p-4">
                @isset($division->chief->card)
                    <h3 class="font-semibold text-xl">
                        {{$division->chief->card->full_name}}
                    </h3>
                @endisset

                @isset($division->chief)
                    <h3 class="font-semibold ">
                        {{$division->chief->post}}
                    </h3>
                @endisset

                @if($division->contacts->count())
                    <h4 class="text-lg font-semibold mt-6">
                        Контакты
                    </h4>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            @each('public.contacts.contact',$division->phones,'contact')
                        </div>
                        <div>
                            @each('public.contacts.contact',$division->emails,'contact')
                        </div>
                    </div>
                    @each('public.contacts.address',$division->addresses,'contact')
                @endif

            </div>
        </div>

        <div class="grid grid-cols-[auto_1fr] gap-4 mb-4">
            <div class="menu w-92">
                @include('public.menu.education')
            </div>

            <div class="wrapper">
                <div class="employees-about">
                    <div class="employees-box grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-2">

                        @foreach($division->TeachingStaff as $full_name=>$staff)
                            <div class="bg-white p-3">
                                <span>{{$full_name}}</span>
                            </div>
                            <div class="bg-white p-3 flex flex-col gap-4 ps-6 lg:ps-3">
                                @foreach($staff->posts as $post)
                                    <div>
                                        {{$post}}
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection



