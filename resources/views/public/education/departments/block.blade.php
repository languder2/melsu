<div
    class="bg-neutral-200 px-5 py-3"
>

    <h3 class="font-semibold" >
        {!! $department->name !!}
    </h3>

    <p class="my-3 flex gap-4 items-center">
        <i class="far fa-user"></i>
        {{ $department->chief->card->full_name }}
    </p>

    @if($department->phones->count())
        <div class="my-3">
            @each('public.contacts.contact',$department->phones,'contact')
        </div>
    @endif

    @if($department->phones->count())
        <div class="my-3">
            @each('public.contacts.contact',$department->emails,'contact')
        </div>
    @endif

    @each('public.contacts.address',$department->addresses,'contact')
</div>
