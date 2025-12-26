@props([
    'categories' => collect()
])

<div class="tabs-wrapper">
    @if($categories->count() > 1)
        <div class="tabs flex gap-3 border-b border-gray-200">
            @foreach($categories as $category)
                @continue($category->publicPartners->isEmpty())
                <div
                    @if($loop->first) open @endif
                data-tab="{{ $category->id }}"
                    class="tab cursor-pointer open:font-semibold hover:text-base-red px-4 py-2"

                >
                    {{ $category->name }}
                </div>
            @endforeach
        </div>
    @endif
    @foreach($categories as $category)
        <div
            @if($loop->first) open @endif
        data-tab="{{ $category->id }}"
            class="tabContent overflow-hidden @if(!$loop->first) max-h-0 @endif duration-500 transition-all"
        >
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 py-2 px-1">
                @foreach($category->publicPartners as $partner)
                    @continue($category->publicPartners->isEmpty())
                    <a
                        href="{{ $partner->link ?? '#' }}"
                        class="flex shadow hover:-mt-1 hover:mb-1 duration-300 transition-all"
                        @empty($partner->link)
                            onclick="return false"
                        @endempty
                        target="_blank"
                    >
                        <img
                            src="{{ $partner->image->src }}"
                            alt="{{ $partner->name }}"
                            class="aspect-square object-contain max-h-20 bg-gray-200 p-1"
                        />
                        <div class="p-3 bg-white flex items-center flex-1 font-semibold">
                            {{ $partner->name }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

