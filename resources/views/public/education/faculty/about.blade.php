@extends("layouts.main")

@section('title')
    ФГБОУ ВО "МелГУ: {{$faculty->name}}
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'faculty',$faculty)}}
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
            @isset($faculty->chief->card)
                <img
                    src="{{$faculty->chief->card->avatar->thumbnail}}"
                    alt="{{$faculty->chief->card->full_name}}"
                    class="w-92"
                />
            @endisset

            <div class="flex-1 flex flex-col gap-3 p-4 bg-neutral-100">
                @isset($faculty->chief->card)
                    <h3 class="font-semibold text-xl">
                        {{$faculty->chief->card->full_name}}
                    </h3>
                @endisset

                @isset($faculty->chief)
                    <h3 class="font-semibold ">
                        {{$faculty->chief->post}}
                    </h3>
                @endisset

                @if($faculty->contacts->count())
                    <h4 class="text-lg font-semibold mt-6">
                        Контакты
                    </h4>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            @each('public.contacts.contact',$faculty->phones,'contact')
                        </div>
                        <div>
                            @each('public.contacts.contact',$faculty->emails,'contact')
                        </div>
                    </div>
                    @each('public.contacts.address',$faculty->addresses,'contact')
               @endif

            </div>
        </div>

        <div class="grid grid-cols-[auto_1fr] gap-4 mb-4">
            <div class="menu w-92 pt-14">
                @include('public.menu.education')
            </div>

            <div class="flex flex-col gap-4">
                @each('public.page.content-section',$faculty->sections,'section')
            </div>
        </div>

    </section>
@endsection



