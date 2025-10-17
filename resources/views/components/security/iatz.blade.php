@if($list->count())
    <div class="@container flex flex-col gap-4">
        <h3 class="font-semibold text-2xl">
            Информация АТЗ
        </h3>

        <div class="grid grid-cols-1 @min-4xl:grid-cols-2 gap-3">
            @foreach($list as $img)

                <button popovertarget="modal-img-iatz-{{ $loop->index }}" class="cursor-pointer w-full">
                    <img src="{{ $img }}" alt="" class="w-full">
                </button>
                <div popover="" id="modal-img-iatz-{{ $loop->index }}" class="modal-image transition-discrete starting:open:opacity-0 fixed open:backdrop-brightness-50 max-w-4/5 max-h-4/5 border-2 border-white shadow-md shadow-white">
                    <div class="modal-image-content">
                        <img src="{{ $img }}" alt="" class="w-full">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
