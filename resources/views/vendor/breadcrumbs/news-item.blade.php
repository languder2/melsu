<section class="container hidden lg:block">
    <div class="page-header ">
        <div class="breadcrumbs flex flex-wrap mb-4">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    @unless($loop->first)
                        <span class="after:content-['\2192'] mr-2"></span>
                    @endif

                    <span class="crumb-home font-xs after:ms-2 hover:text-red-900 hover:underline">
                        <a href="{{ $breadcrumb->url }}" class="font-xs">
                            {{ $breadcrumb->title }}
                        </a>
                    </span>

                @endif

            @endforeach
        </div>
    </div>
</section>
