@if($list->links())
    <div class="my-3">
        {{$list->links()}}
    </div>
@endif

<div class="grid lg:grid-cols-3 gap-3">
    @foreach($list->chunk(ceil($list->count() / 3)) as $chunk)
        <div>
            <div class="grid gap-3 justify-items-center  rounded-xl">
                @foreach($chunk as $image)
                    {{view('admin.gallery.image.item',['image'=>$image])}}
                @endforeach
            </div>
        </div>
    @endforeach
</div>

{{$list->links()}}
