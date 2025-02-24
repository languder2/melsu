@if($list->links())
    <div class="my-3">
        {{$list->links()}}
    </div>
@endif

{{--<div class="grid lg:grid-cols-5 gap-3">--}}
{{--    @foreach($list->chunk(ceil($list->count() / 5)) as $chunk)--}}
{{--        <div>--}}
{{--            <div class="grid gap-3 justify-items-center  rounded-xl">--}}
{{--                @foreach($chunk as $image)--}}
{{--                    {{view('admin.gallery.image.item',['image'=>$image])}}--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--</div>--}}


<div class="flex flex-wrap gap-3">
    @foreach($list as $image)
        <div class="max-w-[800px] max-h-[400px] clear-both relative justify-center align-middle items-center">
            {{view('admin.gallery.image.item',['image'=>$image])}}
        </div>
    @endforeach
</div>



{{$list->links()}}
