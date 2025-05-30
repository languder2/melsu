<div class="flex flex-wrap gap-3">
    @foreach($list as $item)
        @component('admin.gallery.gallery.item',compact('item')) @endcomponent
    @endforeach
</div>
