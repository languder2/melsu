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
            "
        >
            @isset($division->chief->card)
                <img
                    src="{{$division->chief->card->avatar->thumbnail}}"
                    alt="{{$division->chief->card->full_name}}"
                    class="w-92"
                />
            @endisset

            <div class="flex-1 flex flex-col gap-3 p-4 bg-neutral-100">
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
                @if($division->departments->count())
                    <h4 class="font-semibold text-lg mb-2">
                        Кафедры
                    </h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @each("public.education.departments.block",$division->departments,'department')
                    </div>
                @endif

                @if($division->FacultyLabs->count())
                    <h4 class="font-semibold text-lg mb-2 mt-6">
                        Лаборатории
                    </h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @each("public.education.departments.block",$division->FacultyLabs,'department')
                    </div>
                @endif

                @if($division->labs->count())
                    <h4 class="font-semibold text-lg mb-2 mt-6">
                        Лаборатории
                    </h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @each("public.education.departments.block",$division->labs,'department')
                    </div>
               @endif

            </div>
        </div>
    </section>
@endsection



