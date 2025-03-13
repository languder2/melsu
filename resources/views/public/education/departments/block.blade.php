<a href="{{$department->link}}"
    class="
        bg-neutral-100 px-5 py-3 flex flex-col
        group

        hover:-mt-1 hover:mb-1 hover:bg-white
        hover:shadow-md hover:shadow-black/5
    "
>

    <h3 class="font-semibold " >
        {!! $department->name !!}
    </h3>

    <div class="flex-grow h-4"></div>

    @if($department->chief)
        <p class="my-2 flex gap-4 items-center">
            <i class="far fa-user text-base-red opacity-70"></i>
            {{ $department->chief->card->full_name }}
        </p>
    @endif

    @if($department->phones->count())
        <div class="my-2">
            @each('public.contacts.contact',$department->phones,'contact')
        </div>
    @endif

    @if($department->emails->count())
        <div class="my-2">
            @each('public.contacts.contact',$department->emails,'contact')
        </div>
    @endif
</a>
