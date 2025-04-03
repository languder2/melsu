@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')
@section('aside')
    @component('public.menu.aside-tree',['menu' => $menu])@endcomponent
@endsection

@section('content')

    <div>
        @foreach ($handbooks as $category => $items)
            <h2 class="text-2xl mb-3 font-semibold">{{ $category }}</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach ($items as $item)
                    <div style="--item-color: {{$item->color}}; border-color: {{$item->color}};" class="block-with-triangle p-6 min-h-[200px] relative inline-block border border-[{{$item->color}}] before:bg-[{{$item->color}}] after:bg-[#FAFAFA]">
                        <a href="{{ $item->link }}">
                            <div class="mb-6">
                                <img class="colored-svg max-w-[46px] max-h-[46px] inline-block" data-color="{{$item->color}}" src="{{ Storage::url($item->icon) }}" alt="Icon">
                            </div>
                            <h2 class="text-xl underline decoration-line decoration-1 decoration-[#E5E5E5] underline-offset-6 hover:decoration-red-900 hover:text-red-900 transition duration-300 ease-linear w-fit">{{ $item->title }}</h2>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
            </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coloredSvgs = document.querySelectorAll('.colored-svg');

            coloredSvgs.forEach(img => {
                const color = img.dataset.color;
                fetch(img.src)
                    .then(response => response.text())
                    .then(svg => {
                        const temp = document.createElement('div');
                        temp.innerHTML = svg;
                        const paths = temp.querySelectorAll('path, circle, rect');
                        paths.forEach(path => {
                            path.setAttribute('fill', color);
                        });
                        img.src = 'data:image/svg+xml;base64,' + btoa(temp.innerHTML);
                    });
            });
        });
    </script>
@endsection
