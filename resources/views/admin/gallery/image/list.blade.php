<h2>
    Image Gallery
</h2>
@if($list->links())
    <div class="my-3">
        {{$list->links()}}
    </div>
@endif
<div class="grid lg:grid-cols-5 gap-3">
    @foreach($list->chunk(ceil($list->count() / 5)) as $chunk)
        <div>
            <div class="grid gap-3 justify-items-center  rounded-xl">
                @foreach($chunk as $image)
                    <div
                        @class([
                            'transition-all duration-200',
                            'grayscale hover:grayscale-0',
                            'bg-white rounded-lg',
                            'w-full lg:w-auto lg:min-w-60',
                            'relative',
                            ($image->filetype !== 'svg')?"":"p-4",
                            'cursor-pointer',
                        ])
                        onclick="ClipBoard.copyTextToClipboard('../../..{{$image->src}}')"

                    >
                        <img src="{{$image->thumbnail}}" alt="image" class="rounded-lg" />
                        <div
                            class="
                                absolute
                                bottom-0 left-0 right-0
                                px-4 py-2 bg-black/70 text-white
                                rounded-b-lg
                                flex
                                items-center
                            "
                        >
                            <span class="inline-block flex-1 pr-6">
                                {{$image->id}}
                                {{$image->name}}
                            </span>
                            <span class="w-4 text-right">
                                <i class="far fa-clone"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

{{$list->links()}}
