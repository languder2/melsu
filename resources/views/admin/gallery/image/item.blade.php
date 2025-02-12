<label
    @class([
        'transition-all duration-200',
        'grayscale hover:grayscale-0',
        'has-checked:grayscale-0',
        'bg-white rounded-lg',
        'w-full lg:w-auto lg:min-w-60',
        'relative',
        ($image->filetype !== 'svg')?"":"p-4",
        'cursor-pointer',
        'group',
        'select-none',
    ])
>
    <a
        href="{{route('admin:gallery:image:form',[$image->id])}}"
        class="fixed right-2 top-2 bg-white text-xl py-2 px-3 rounded-2xl hover:bg-blue-700 hover:text-white"
    >
        <i class="fas fa-pencil-alt"></i>
    </a>

    <input type="radio" name="select_image" class="hidden"
           onclick="ClipBoard.copyTextToClipboard('../../..{{$image->src}}','Адрес изображения скопирован\n{{$image->id}} {{$image->name}}')"
    />
    <img src="{{$image->thumbnail}}" alt="image" class="rounded-lg"  />
    <span
        class="
            absolute
            bottom-0 left-0 right-0
            px-4 py-2 bg-black/70 text-white
            rounded-b-lg
            flex
            items-center
            group-hover:bg-red-700/50
            group-has-checked:bg-green-700/50
        "
    >
        <span class="inline-block flex-1 pr-6">
            {{$image->id}}
            {{$image->name}}
        </span>
        <span class="w-4 text-right">
            <i class="far fa-clone"></i>
        </span>
    </span>
</label>
