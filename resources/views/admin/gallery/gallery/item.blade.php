<div
    class="
        gallery-item
        relative rounded-lg
        transition-all duration-200
        hover:-mt-2px
        hover:mb-2px
        hover:drop-shadow-[3px_5px_5px_rgba(0,0,0,.5)]
        select-none
        min-w-60
    "
>
    <img
        src="{{optional($item->preview)->thumbnail}}"
        alt="{{$item->name}}"
        class="
            h-80
            relative rounded-lg
            transition-all duration-300
        "
    >

    <div
        class="
            absolute inset-0 end-0 flex flex-col
            items-end
        "
    >
        <x-html.blocks.check-button
            onclick="Actions.ToggleShow(this,'{{route('gallery-toggle-show',$item->id)}}')"
            :checked="$item->show"
        >
            <i class="fas fa-toggle-on hidden text-green-700 group-has-checked:block"></i>
            <i class="fas fa-toggle-off block text-red-700 group-has-checked:hidden"></i>
        </x-html.blocks.check-button>

        <x-html.blocks.a-button
            hoverColor="text-blue-700"
            :href="route('admin:gallery:image:form',$item->id)"
        >
            <i class="fas fa-pencil-alt"></i>
        </x-html.blocks.a-button>

        <x-html.blocks.a-button
            hoverColor="text-blue-700"
        >
            <i class="fas fa-layer-group"></i>
        </x-html.blocks.a-button>

        <x-html.blocks.a-button
            hoverColor="text-blue-700"
            :href='$item->AddImages'
        >
            <i class="fas fa-plus"></i>
        </x-html.blocks.a-button>


        <span class="flex-grow-5"></span>

        <x-html.blocks.a-button
            hoverColor="text-red-700"
            onclick="Actions.DeleteItem(this.closest('.gallery-item'),'{{route('gallery-delete',$item->id)}}')"
            DeleteItem
        >
            <i class="fas fa-recycle"></i>
        </x-html.blocks.a-button>


        <x-html.blocks.bottom-header>
            <span>
                #{{$item->id}}
            </span>


            <span class="border-r border-r-stone-50/30"></span>

            <span>
                {{str_pad($item->images->count(), 3, '0', STR_PAD_LEFT)}}
            </span>

            <span class="border-r border-r-stone-50/30"></span>

            <span class="text-right flex-1">
                {{$item->name}}
            </span>
        </x-html.blocks.bottom-header>
    </div>

</div>
