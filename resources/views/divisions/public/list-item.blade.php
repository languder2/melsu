@props([
    'division'  => new \App\Models\Division\Division()
])

@php if(!$division->exists) return; @endphp

<div class="flex flex-col gap-3 @if(!$division->depth) list-line-group @endif">
    <div class="grid grid-cols-1 lg:grid-cols-3 bg-white">
        <a href="{{ $division->link }}" class="col-span-2  p-3 ps-5 group flex gap-3">
            @if($division->depth)
                <span class="flex items-start pt-1">
                    @for( $i = 1; $i < $division->depth; $i++ )
                        <span class="inline-block mx-3"></span>
                    @endfor

                    <i class="fas fa-level-up-alt rotate-90 mx-2"></i>
                </span>
            @endif

            <span class="group-hover:underline underline-offset-2">
                {!! $division->name !!}
            </span>
        </a>
        <div @class([
                "p-3 ps-5",
                $division->leader->exists ? 'lg:block' : 'hidden'
             ])
        >
            {!! $division->leader->fullname ?: '-' !!}
        </div>
    </div>

    @each('divisions.public.list-item', $division->children()->withDepth()->public()->get(), 'division')
</div>
