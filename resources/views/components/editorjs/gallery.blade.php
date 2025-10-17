@if($block->data->caption)
    <h3>
        {!! $block->data->caption !!}
    </h3>
@endif

@if(count($block->data->files)<=3)
    <div class="flex flex-col lg:flex-row gap-3 justify-center-safe">
        @foreach($block->data->files as $i=>$image)
            <button popovertarget="modal-img-{{$block->id}}-{{$i}}" class="cursor-pointer flex-auto">
                <img src="{{$image->url}}" alt="" class="h-full w-full object-cover">
            </button>
            <div popover="" id="modal-img-{{$block->id}}-{{$i}}" class="modal-image transition-discrete starting:open:opacity-0 fixed open:backdrop-brightness-50 max-w-4/5 max-h-4/5 border-2 border-white shadow-md shadow-white">
                <img src="{{$image->url}}" alt="" class="object-contain">
            </div>
        @endforeach
    </div>
@else

    <div class="editor-slider">
        <div class="slides w-full h-svw lg:h-600 relative">
            @foreach($block->data->files as $i=>$image)
                <button popovertarget="modal-img-slider-{{ $block->id }}-slide-{{$i}}" data-slide="{{ $i }}" @if(!$i) open @endif class="slide w-full h-full absolute inset-0 opacity-0 open:z-10 open:opacity-100 bg-gray-300 p-1 duration-1000 rounded-md shadow">
                    <img src="{{$image->url}}" alt="" class="h-full w-full object-contain">
                </button>
                <div popover="" id="modal-img-slider-{{ $block->id }}-slide-{{$i}}" class="modal-image transition-discrete starting:open:opacity-0 fixed open:backdrop-brightness-50 border-2 border-white shadow-md shadow-white">
                    <img src="{{$image->url}}" alt="" class="">
                </div>
            @endforeach
        </div>
        <div class="triggers overflow-hidden mt-2">
            <div class="grab-block flex gap-3 py-2 px-2px select-none">
                @foreach($block->data->files as $i=>$image)
                    <img
                        src="{{$image->url}}" alt=""
                        @if(!$loop->index) open @endif
                        class="
                        trigger
                        grayscale-75 open:grayscale-0 hover:grayscale-0
                        border border-white
                        hover:-mt-1 hover:mb-1 duration-300 transition-[margin]
                        shadow-md shadow-indigo-500 open:shadow-red-800 hover:shadow-red-800
                        rounded-md
                        object-contain h-20 lg:h-32
                        cursor-pointer

                    "
                        data-slide="{{ $i }}"
                    >
                @endforeach
                    <div class="opacity-0 ">
                        1
                    </div>
            </div>
        </div>
    </div>

@endif



