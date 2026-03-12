@props([
    'division'  => new \App\Models\Division\Division()
])

@php if (!$division->exists) return; @endphp

<hr class="col-span-2">
<div class="break-words sm:break-normal text-sm sm:text-base">
    @for( $i = 1; $i < $division->depth; $i++ )
        <span class="inline-block mx-3"></span>
    @endfor

    @if($division->depth)
        <i class="fas fa-level-up-alt rotate-90 mx-2"></i>
    @endif
    <a
        href="{!! $division->relation->link ?? $division->link !!}"
        class="hover:underline hover:text-base-red"
    >
        {!! $division->name !!}
    </a>
</div>
<div class="break-words sm:break-normal text-sm sm:text-base">
    @if($division->leader->exists)
        <a
            href="{!! $division->leader->staff->link!!}"
            class="hover:underline hover:text-base-red"
        >
            {!! $division->leader->full_name!!}
        </a>
    @else
        -
    @endif
</div>

@each('divisions.public.list.division', $division->children()->withDepth()->get(), 'division')
