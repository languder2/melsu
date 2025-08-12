<div @class([$item->is_show ? 'text-green-700' : 'text-red-700'])>
    {!! $item->id !!}
</div>
<div class="text-center">
{{--    <a--}}
{{--        href="{{ route('documents:admin:form') }}?category_id={{$item->category->id ?? null}}&parent_id={{$item->id}}"--}}
{{--        class="--}}
{{--                rounded-md--}}
{{--                text-blue-950 hover:text-blue-700 active:text-gray-700--}}
{{--                flex items-center justify-center--}}
{{--            "--}}
{{--    >--}}
{{--        <i class="far fa-plus-square text-2xl"></i>--}}
{{--    </a>--}}
</div>
<div class="text-center">
    {!! $item->sort !!}
</div>
<div>
    <a href="{{ $item->relation_form }}"
       class="underline hover:text-blue"
    >
        {!! $item->title !!}
    </a>
</div>
<div>
    @if($item->link)
        <a href="{{ $item->link }}" class="flex gap-4" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
            </svg>

            <span class="underline">
                {{ $item->filename }}
            </span>
        </a>
    @endif
</div>
<div>
    <div>
        <button
            popovertarget="link-for-delete-{{$item->id}}"
            class="
                        p-1 rounded-md
                        text-red-700
                        hover:text-red-700
                        active:text-gray-700
                        cursor-pointer
                    "
        >
            <i class="fas fa-trash w-4 h-4"></i>
        </button>
        <div popover=""
             id="link-for-delete-{{$item->id}}"
             class="
                        relative inset-y-0 mx-auto my-auto
                        transform overflow-hidden
                        rounded-lg bg-white text-left
                        opacity-0 shadow-xl transition-all [transition-behavior:allow-discrete] duration-300
                        sm:w-full sm:max-w-600 [&:is([open],:popover-open)]:opacity-100
                        [@starting-style]:[&:is([open],:popover-open)]:opacity-0
                    "

        >
            <h3 class="p-4 font-semibold">
                Удалить документ?
            </h3>
            <hr>
            <div class="p-4">
                <a href="{{ $item->link }}" class="flex gap-4" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                    </svg>

                    <span class="underline">
                        {{ $item->filename }}
                    </span>
                </a>
            </div>
            <hr>
            <div class="text-right px-4">
                    <a
                        href="{{ route('documents:delete',$item) }}"
                        class="
                            inline-block relative
                            py-2 px-4 text-white rounded-md shadow-md
                            shadow-gray-300
                            bg-red-800 hover:bg-red-700 active:bg-gray-700
                            hover:-mt-px hover:mb-px
                        "
                    >
                        удалить
                    </a>
            </div>
        </div>
    </div>
</div>

<hr class="col-span-6 last:hidden">

@if(!$item->subs->isEmpty())
    @each('documents.admin.item',$item->subs,'item')
@endif


