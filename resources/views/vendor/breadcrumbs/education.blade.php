<div class="container pt-6 z-5 relative text-gray-100 flex  gap-3 flex-wrap">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !($loop->last && $loop->count>2) )
            <div class="hover:underline duration-300 flex gap-3">
                @unless($loop->first)
                    <span class=""> → </span>
                @endif

                <a href="{{ $breadcrumb->url }}" class="font-xs text-nowrap">
                    {!! $breadcrumb->title !!}
                </a>
            </div>

        @endif

    @endforeach
</div>
