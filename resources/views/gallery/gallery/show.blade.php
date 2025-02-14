<section class="container">
    <div class="flex flex-wrap gap-4">
        @foreach($gallery->images as $image)
            <div
                class="
                    relative rounded-lg
                    transition-all duration-200
                    hover:-mt-2px
                    hover:mb-2px
                    hover:drop-shadow-[3px_5px_5px_rgba(0,0,0,.5)]
                    select-none
                "
            >
                <button popovertarget="modal-img-{{$image->id}}" class="cursor-pointer">
                    <img
                        src="{{optional($image)->thumbnail}}"
                        alt="{{$image->name}}"
                        class="
                            h-68
                            relative rounded-lg
                            transition-all duration-300
                        "
                    >
                    <div class="absolute inset-x-0 bottom-0">
                        <x-html.blocks.bottom-header>
                    <span class="text-center flex-1">
                        {{$image->name}}
                    </span>
                        </x-html.blocks.bottom-header>
                    </div>

                </button>
                <div popover id="modal-img-{{$image->id}}"
                     class="modal-image transition-discrete starting:open:opacity-0 fixed open:backdrop-brightness-50">
                    <div class="modal-image-content">
                        <img
                            src="{{optional($image)->src}}"
                            alt="{{$image->name}}"
                        >
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</section>
