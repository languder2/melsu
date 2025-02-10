<section class="container hidden lg:block">
    <div class="page-header pt-3 pb-6 ">

        <div class="breadcrumbs flex flex-wrap mb-4">


            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !($loop->last && $loop->count>2) )
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

        <h1 class="text-3xl sm:text-5xl font-bold">
            {{$breadcrumb->title??''}}
        </h1>
    </div>
</section>
