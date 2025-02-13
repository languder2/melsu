<div class="flex flex-wrap gap-3">
    @foreach($list as $item)
        <div class="max-w-[800px] max-h-[400px] clear-both relative justify-center align-middle items-center">
            {{view('admin.gallery.gallery.item',['item'=>$item])}}
        </div>
    @endforeach
</div>
