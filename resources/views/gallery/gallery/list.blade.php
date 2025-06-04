<section class="container">
    <div class="flex flex-wrap gap-3 mb-3">
        @foreach($list as $item)
            @component('gallery.gallery.item',compact('item')) @endcomponent
        @endforeach
    </div>
</section>
