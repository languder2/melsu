<div
    class="bg-neutral-100 px-5 py-3"
>

    <h3 class="font-semibold" >
        {!! $department->name !!}
    </h3>

    @if($department->chief)
        <p class="my-3 flex gap-4 items-center">
            <i class="far fa-user"></i>
            {{ $department->chief->card->full_name }}
        </p>
    @endif

    @if($department->phones->count())
        <div class="my-3">
            @each('public.contacts.contact',$department->phones,'contact')
        </div>
    @endif

    @if($department->emails->count())
        <div class="my-3">
            @each('public.contacts.contact',$department->emails,'contact')
        </div>
    @endif
</div>
