<div class="flex flex-wrap gap-3">
    @foreach($list as $item)
        {{view('admin.gallery.gallery.item',['item'=>$item])}}
    @endforeach
</div>
