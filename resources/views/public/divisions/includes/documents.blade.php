@foreach($categories as $item)
    @foreach($item->subs as $category)
        @continue($category->getDocuments()->isEmpty())
        <div class="about-otdel mb-4 last:mb-0">
            <h2 class="font-semibold py-6 text-xl">
                {!! $category->name !!}
            </h2>
            <div class="bg-white p-6 flex flex-col gap-4 ul-correct">

                @foreach($category->getDocuments() as $document)
                    <li class="py-1">
                        <a
                            href="{{ $document->link }}"
                            target="_blank"
                            class="hover:ms-2 duration-300 transition-all hover:text-base-red"
                        >
                            {!! $document->title !!}
                        </a>

                        @if($document->publicSubs->count())
                            <ul class="mt-2">
                                @each("documents.public.item",$document->publicSubs,'document')
                            </ul>
                        @endif
                    </li>

                @endforeach
            </div>
        </div>
    @endforeach
@endforeach
