<div class="h-80 relative shadow-lg shadow-white hover:shadow-indigo-500 duration-300 gallery-item">
    <img
        src="{{ $image->thumbnail }}"
        alt=""
        class="w-full h-full object-cover "
    >
    <div class="
            absolute inset-0 end-0 flex flex-col
            items-end
        ">

        <x-html.blocks.check-button
            onclick="Actions.ToggleShow(this,'{{ $image->ApiToggleShow }}')"
            :checked="$image->show"
        >
            <i class="fas fa-toggle-on hidden text-green-700 group-has-checked:block"></i>
            <i class="fas fa-toggle-off block text-red-700 group-has-checked:hidden"></i>
        </x-html.blocks.check-button>

        <x-html.blocks.a-button
            hoverColor="text-blue-700"
            :href="$image->edit"
        >
            <i class="fas fa-pencil-alt"></i>
        </x-html.blocks.a-button>

{{--        <x-html.blocks.a-button--}}
{{--            hoverColor="text-blue-700"--}}
{{--            onclick=""--}}
{{--        >--}}
{{--            <i class="far fa-copy"></i>--}}
{{--        </x-html.blocks.a-button>--}}

        <x-html.blocks.a-button
            hoverColor="text-blue-700"
            onclick="ClipBoard.copyTextToClipboard('{{ url($image->src) }}','Адрес изображения скопирован\n{{$image->id}} {{$image->name}}')"
        >
            <i class="fas fa-link"></i>
        </x-html.blocks.a-button>

        <span class="flex-grow-5"></span>

        <x-html.blocks.a-button
            hoverColor="text-red-700"
            onclick="Actions.DeleteItem(this.closest('.gallery-item'),'{{ $image->ApiDelete }}')"
        >
            <i class="fas fa-recycle"></i>
        </x-html.blocks.a-button>

        <x-html.blocks.bottom-header>
            <span>
                #{{$image->id}}
            </span>

            <span class="border-r border-r-stone-50/30"></span>

            <span class="text-right flex-1">
                {{$image->name}}
            </span>

        </x-html.blocks.bottom-header>
    </div>
</div>
