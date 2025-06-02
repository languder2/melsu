<div class="grid grid-cols-1 lg:grid-cols-2 gap-1">
    @foreach($gallery->publicImages() as $image)
        <div class="flex-auto ">
            <img
                src="{{$image->src}}"
                alt=""
                class="w-full h-full object-cover"
            />
        </div>
    @endforeach
</div>

{{--<div class="flex flex-wrap gap-2">--}}
{{--    @foreach($gallery->publicGallery() as $image)--}}
{{--        <div class="flex-auto " style="height: 500px">--}}
{{--            <img--}}
{{--                src="{{$image->src}}"--}}
{{--                alt=""--}}
{{--                class="w-full h-full object-cover"--}}
{{--            />--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--</div>--}}


