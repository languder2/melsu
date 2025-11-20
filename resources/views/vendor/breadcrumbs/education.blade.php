<div class="container pt-6 z-5 relative text-gray-100">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !($loop->last && $loop->count>2) )
            @unless($loop->first)
                <span class="px-1"> → </span>
            @endif

            <span class="hover:underline duration-300">
                <a href="{{ $breadcrumb->url }}" class="font-xs">
                    {!! $breadcrumb->title !!}
                </a>
            </span>

        @endif

    @endforeach
</div>
