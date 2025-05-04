@if(isset($list) && !$list->isEmpty())
    <section>
        <div class="box-heading container custom lg:p-3">
            <h2 class="font-bold text-3xl mb-3 mt-8">
                {!! $slot !!}
            </h2>
        </div>
        <ul class="bg-white p-6 flex flex-col gap-4">
            @foreach($list as $item)
                <li class="">
                    <a href="{{ $item->link }}" class="flex items-center gap-3" target="_blank">

                        <i
                            class="bi bi-file-earmark-pdf-fill text-red-700 text-3xl"></i>
                        {!! $item->title !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
@endif
