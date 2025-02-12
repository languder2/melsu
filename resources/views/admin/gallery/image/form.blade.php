<x-head.tinymce-config/>
<form
    action="{{route('admin:gallery:image:save')}}"
    method="POST"
    enctype="multipart/form-data"
    @class([
        "p-4 bg-white rounded-md",
        "max-w-[1200px]",
        "mx-auto",
        $current?"flex gap-4":""
    ])
>
    @csrf
{{--    <div @class([($current->oriental === 'horizontal')?"w-96":"w-52"])>--}}
    <div class="max-h-12">
        <img src="{{$current->thumbnail}}" alt="" class="max-h-64" />
    </div>
    <div class="flex-1">
        <h3 class="pb-2 font-semibold text-xl uppercase text-center">
            @if(isset($current->id))
                Внести изменения
            @else
                Добавить изображение
            @endif
        </h3>

        <hr>

        <x-form.errors/>

        <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>



        <x-form.input
            id="form_name"
            name="name"
            label="Название"
            value="{{ old('name') ?? optional($current)->name }}"
            required
        />

        <x-form.input
            id="form_alt"
            name="alt"
            label="Альтернативное название"
            value="{{ old('alt') ?? optional($current)->alt }}"
        />

        <div>
            <x-form.file
                id="form_image"
                name="image"
                label="File"
                value="{{old('image') ?? optional($current)->src}}"
            />
        </div>

        <x-form.submit
            class="uppercase"
            value="сохранить"
        />
    </div>
</form>
