<hr class="col-span-2">
<div class="break-words sm:break-normal text-sm sm:text-base">
    @for($i=1;$i<$depth;$i++)
        <span class="inline-block mx-3"></span>
    @endfor

    @if($depth)
        <i class="fas fa-level-up-alt rotate-90 mx-2"></i>
    @endif

    @if($division->PublicSectionsCount)
        <a
            href="{!! $division->relation->link ?? $division->link !!}"
            class="hover:underline hover:text-base-red"
        >
            {!! $division->name !!}
        </a>
    @else
        {!! $division->name !!}
    @endif
</div>
<div class="break-words sm:break-normal text-sm sm:text-base">
    @if($division->leader->exists)
        <a
            href="{!! $division->leader->link!!}"
            class="hover:underline hover:text-base-red"
        >
            {!! $division->leader->full_name!!}
        </a>
    @else
        -
    @endif
</div>

@if($division->subs->count())
    @foreach($division->subs as $sub)
        @component("divisions.public.list.division",['division' => $sub,'depth' => $depth+1])@endcomponent
    @endforeach
@endif


