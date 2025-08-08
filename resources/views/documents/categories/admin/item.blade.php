<div @class(["text-center", $item->is_show ? 'text-green-700' : 'text-red-700'])>
    {!! $item->id !!}
</div>
<div class="text-center">
    {!! $item->sort !!}
</div>
<div class="flex flex-row gap-4">
    @if($level)
        @for($i=0; $i<$level; $i++)
            <div></div>
        @endfor
        <div>
            <i class="fas fa-level-up-alt rotate-90"></i>
        </div>
    @endif

    <div class="flex-1">
        <a href="{{ route('document-categories:admin:form',$item) }}" class="underline hover:text-blue">

            {!! $item->name !!}
        </a>
    </div>
</div>
<div>
    <div>
        <button
            popovertarget="link-for-delete-{{$item->id}}"
            class="
                        p-1 rounded-md
                        text-red-700
                        hover:text-red-700
                        active:text-gray-700
                        cursor-pointer
                    "
        >
            <i class="fas fa-trash w-4 h-4"></i>
        </button>
        <div popover=""
             id="link-for-delete-{{$item->id}}"
             class="
                        relative inset-y-0 mx-auto my-auto
                        transform overflow-hidden
                        rounded-lg bg-white text-left
                        opacity-0 shadow-xl transition-all [transition-behavior:allow-discrete] duration-300
                        sm:w-full sm:max-w-600 [&:is([open],:popover-open)]:opacity-100
                        [@starting-style]:[&:is([open],:popover-open)]:opacity-0
                    "

        >
            <h3 class="p-4 font-semibold">
                Удалить категорию.
            </h3>
            <hr>
            <div class="p-4">
                {!! $item->name !!}
            </div>
            <hr>
            <div class="text-right p-4">
                <a
                    href="{{ route('document-categories:delete',$item) }}"
                    class="
                                inline-block relative
                                py-2 px-4 text-white rounded-md shadow-md
                                shadow-gray-300
                                bg-red-800 hover:bg-red-700 active:bg-gray-700
                                hover:-mt-px hover:mb-px
                            "
                >
                    удалить
                </a>
            </div>
        </div>


    </div>
</div>

<hr class="col-span-4 last:hidden">

@foreach($item->subs as $sub)
    @include('documents.categories.admin.item', ['item' => $sub, 'level' => $level+1])
@endforeach

