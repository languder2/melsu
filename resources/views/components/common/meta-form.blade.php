@props([
    'meta' => collect(),
    'header' => null,
])

@if(auth()->user()->isEditor())
    @if($header)
        <h3 class="font-semibold text-xl lg:col-span-2 my-2">
            Метатеги
        </h3>
    @endif

    <div class="grid gap-3 grid-cols-1 lg:grid-cols-2 bg-white py-3 px-4">
        <div>
            <x-form.input
                    name="meta[title]"
                    label="Title (если не заполнен - генерирует на основе названия)"
                    value="{!! old('meta.title', $meta['title'] ?? null) !!}"
            />
        </div>
        <div>
            <x-form.input
                    name="meta[keywords]"
                    label="Keywords"
                    value="{!! old('meta.keywords', $meta['keywords'] ?? null) !!}"
            />
        </div>
        <div class="lg:col-span-2">
            <x-form.input
                    name="meta[description]"
                    label="Description"
                    value="{!! old('meta.description', $meta['description'] ?? null) !!}"
            />
        </div>
        <div>
            <x-form.input
                    name="meta[og_title]"
                    label="og:title (если не заполнен - берет title)"
                    value="{!! old('meta.og_title', $meta['og_title'] ?? null) !!}"
            />
        </div>
        <div>
            <x-form.input
                    name="meta[og_site_name]"
                    label="og:site_name"
                    value="{!! old('meta.og_site_name', $meta['og_site_name'] ?? 'ФГБОУ ВО «МелГУ»') !!}"
            />
        </div>

        <div class="lg:col-span-2">
            <x-form.input
                    name="meta[og_description]"
                    label="og:description (если не заполнен - description)"
                    value="{!! old('meta.og_description', $meta['og_description'] ?? null) !!}"
            />
        </div>

        <div class="flex gap-3 items-center">
            <x-form.input
                    name="meta[og_image]"
                    label="og:image (ссылка)"
                    value="{!! old('meta.og_image', $meta['og_image'] ?? null) !!}"
                    block="flex-1"
            />

            @if($meta->get('og_image'))
                <a href="{{ $meta['og_image'] }}" class="px-4" target="_blank">
                    <x-lucide-external-link class="w-8 hover:text-blue-800" />
                </a>
            @endif
        </div>

        <div>
            <x-form.file
                    id="meta_image"
                    label="Загрузить изображение"
                    name="meta[image]"
                    block="flex-1"
            />
        </div>
    </div>
@endif
