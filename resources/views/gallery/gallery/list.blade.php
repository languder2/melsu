<section class="container">
    <div class="flex flex-wrap gap-3">
        @foreach($list as $item)
            {{view('gallery.gallery.item',['item'=>$item])}}
        @endforeach
    </div>
</section>
