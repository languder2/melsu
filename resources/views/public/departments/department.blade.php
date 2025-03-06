<hr class="col-span-2">
<div>
    @for($i=1;$i<$depth;$i++)
        <span class="inline-block mx-3"></span>
    @endfor

    @if($depth)
        <i class="fas fa-level-up-alt rotate-90 mx-2"></i>
    @endif

    @if($department->sections->count() || $department->staffs->count())
        <a
            href="{{ $department->relation->link ?? $department->link }}"
            class="hover:underline hover:text-base-red"
        >
            {{ $department->name }}
        </a>
    @else
            {{ $department->name }}
    @endif
</div>
<div>
    @if($department->chief)
        <a
            href="{{ $department->chief->card->link}}"
            class="hover:underline hover:text-base-red"
        >
            {{ $department->chief->card->full_name}}
        </a>
    @else
        -
    @endif
</div>

@if($department->subs->count())
    @foreach($department->subs as $sub)
        @include("public.departments.department",['department' => $sub,'depth' => $depth+1])
    @endforeach
@endif
