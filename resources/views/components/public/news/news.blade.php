<section class="main-section">
    <section class="container custom">
        <div class="page-header pt-14 mb-5 lg:mb-10">
            {{ Breadcrumbs::view('vendor.breadcrumbs.news-item', 'news-item', $news) }}
            <h1 class="text-4xl font-bold block pb-5 border-b">
                {!! $news->title !!}
            </h1>
            <div class="flex items-center gap-3 mt-3">
                @if($news->tag)
                    <span class="bg-[#f3f3f3] text-[#989ea9] p-2">
                        {{$news->tag->name}}
                    </span>
                @endif
                <span class="text-[var(--primary-color)]">
                    <i class="bi bi-calendar2-week"></i>
                        {{ $news->published_at }}
                </span>
            </div>
        </div>
    </section>
    <div class="hidden aspect-video"></div>
    <div class="container custom">
        <div class="grid sm:grid-cols-[2fr_1fr] gap-10 mb-5 items-start">
            <div class="content-news mb-3 codex-editor flex flex-col gap-4 text-justify">
                {!! $news->content_html !!}
            </div>
            <div class="relative">
                @if($relatedNews && $relatedNews->isNotEmpty())
                    <div class="flex items-center justify-between pr-5 gap-5 border-b w-full pb-2">
                        <h3 class="text-lg font-semibold">Еще новости</h3>
                        <div class="flex items-center gap-[1px]">
                            <button id="scroll-prev" class="bg-white border group hover:bg-[#C10F1A] transition duration-300 ease-linear cursor-pointer p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-up text-gray-700 group-hover:text-white transition duration-300 ease-linear" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                                </svg>
                            </button>
                            <button id="scroll-next" class="bg-white border group hover:bg-[#C10F1A] transition duration-300 ease-linear cursor-pointer p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-down text-gray-700 group-hover:text-white transition duration-300 ease-linear" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="related-news-container" class="hide-scrollbar overflow-y-auto pr-2 min-h-[169px]">
                        @foreach($relatedNews as $index => $item)
                            <div id="related-item-{{ $index }}" class="border-b py-5 last:border-b-0">
                                <a href="{{ $item->link }}" class="grid grid-cols-[180px_auto] gap-5 group">
                                    @if($item->preview)
                                        <div class="mb-2">
                                            <img src="{{ $item->preview->thumbnail }}" alt="{{ $item->title }}" class="w-full h-[120px] object-cover rounded">
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-base group-hover:text-[#C10F1A] transition-colors line-clamp-2">
                                            {{ $item->title }}
                                        </div>
                                        @if($item->tag)
                                            <div class="text-sm bg-[#f3f3f3] text-[#989ea9] p-2 mt-2 w-fit">
                                                {{ $item->tag->name }}
                                            </div>
                                        @endif
                                        <div class="text-sm text-gray-400 mt-1">
                                            {{ $item->publication_at }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const container = document.getElementById('related-news-container');
        const prevBtn = document.getElementById('scroll-prev');
        const nextBtn = document.getElementById('scroll-next');
        const mainContent = document.querySelector('.content-news');

        if (!container || !prevBtn || !nextBtn || !mainContent || container.children.length === 0) {
            return;
        }

        const totalItems = container.children.length;
        let currentIndex = 0;
        let visibleCount = 1;

        function syncHeight() {
            const mainHeight = mainContent.offsetHeight;
            const minHeight = 169;
            container.style.maxHeight = Math.max(mainHeight, minHeight) + 'px';
        }

        function calculateVisibleCount() {
            const firstItem = container.children[0];
            if (!firstItem) return 1;

            const itemHeight = firstItem.offsetHeight || 169;
            const containerHeight = container.clientHeight || 169;
            const count = Math.floor(containerHeight / itemHeight);
            return Math.max(1, count);
        }

        function scrollToIndex(index) {
            if (index < 0 || index >= totalItems) return;
            const target = container.children[index];
            if (!target) return;

            const offset = 39;
            container.scrollTo({
                top: target.offsetTop - offset,
                behavior: 'smooth'
            });

            currentIndex = index;
            updateButtons();
        }

        function updateButtons() {
            const controls = prevBtn.closest('.flex.items-center');
            if (!controls) return;

            if (visibleCount >= totalItems) {
                controls.style.display = 'none';
            } else {
                controls.style.display = 'flex';
                prevBtn.disabled = currentIndex === 0;
                nextBtn.disabled = currentIndex + visibleCount >= totalItems;
            }
        }

        async function init() {
            syncHeight();

            await imagesLoaded(container);

            syncHeight();

            visibleCount = calculateVisibleCount();
            updateButtons();

            if (container.scrollHeight > container.clientHeight) {
                scrollToIndex(0);
            }
        }

        prevBtn.addEventListener('click', () => {
            const newIndex = Math.max(0, currentIndex - visibleCount);
            scrollToIndex(newIndex);
        });

        nextBtn.addEventListener('click', () => {
            const newIndex = Math.min(totalItems - 1, currentIndex + visibleCount);
            scrollToIndex(newIndex);
        });

        function imagesLoaded(container) {
            const images = container.querySelectorAll('img');
            if (images.length === 0) return Promise.resolve();
            return Promise.all(
                Array.from(images).map(img => {
                    if (img.complete && img.naturalHeight !== 0) {
                        return Promise.resolve();
                    }
                    return new Promise((resolve) => {
                        img.addEventListener('load', resolve, { once: true });
                        img.addEventListener('error', resolve, { once: true });
                    });
                })
            );
        }

        init();
        window.addEventListener('load', init);
        window.addEventListener('resize', init);
    });
</script>

<style>
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>