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
            class="w-92 hidden xl:block"
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 stroke-base-red">
                <div>
                    @each('public.contacts.contact',$division->phones,'contact')
                </div>
                <div>
                    @each('public.contacts.contact',$division->emails,'contact')
                </div>
            </div>
            <div class="fill-base-red">
                @each('public.contacts.address',$division->addresses,'contact')
            </div>
        @endif

    </div>
</div>
