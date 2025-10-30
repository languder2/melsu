<div class="relative shadow-md rounded-md overflow-hidden {{ $item->has_approval ? "" : "shadow-red-700" }}">
    <img src="{{ $item->preview->thumbnail }}" alt=""
         class="h-96 w-128 object-cover object-top"
    />
    <div
        class="
            absolute inset-3 flex flex-col gap-3
        "
    >
        @if($item->relation)
            <div class="
                p-3 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100
                {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white" }}
                "
            >
                {!! $item->relation->name !!}
            </div>
        @endif
        @if($item->category)
            <div class="
                p-3 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100
                {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white" }}
                "
            >
                {!! $item->category->name !!}
            </div>
        @endif

        <div class="flex-grow"></div>

        <div class="p-3 bg-indigo-200/55 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100
            {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white"  }}
        ">
            {!! $item->title !!}
        </div>

        <div class="flex gap-3">
            <a  href="{{ $item->cabinet_form }}"
                class="
                    p-1 px-2 hover:bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 flex items-center
                    {{ $item->has_approval ? "bg-indigo-200/55 text-blue-700" : "bg-red-700/55 text-white hover:text-blue-700" }}
                "
            >
                <x-lucide-square-pen class="w-6"/>
            </a>

            <div class="py-1 px-3 {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white" }} rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 flex items-center">
                {!! $item->id !!}
            </div>

            <div class="py-1 px-3 {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white" }} rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 flex items-center">
                {!! $item->event_datetime->format('d-m-Y H:i') !!}
            </div>

            <a  href="{{ $item->link }}" target="_blank"
                class="
                    p-1 px-2  hover:bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 flex items-center
                    {{ $item->has_approval ? "bg-indigo-200/55 text-green-700" : "bg-red-700/55 text-white hover:text-green-700" }}
                "
            >
                <x-lucide-square-arrow-out-up-right class="w-6"/>
            </a>

            <div class="flex-1"></div>

            <div class="py-1 px-3 {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white" }} rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 flex items-center">
                {!! $item->author->name ?? $item->author->email ?? null !!}
            </div>

            <div
                class="
                    p-1 px-2 bg-indigo-200/55 hover:bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 flex items-center
                    {{ $item->has_approval ? "bg-indigo-200/55 text-red-700" : "bg-red-700/55 text-white hover:text-red-700" }}
                "
            >
                <button
                    popovertarget="link-for-delete-{{ $item->id }}"
                    class="
                        p-1 rounded-md
                        cursor-pointer

                    "
                >
                    <x-lucide-trash-2 class="w-6 cursor-pointer"/>
                </button>

                <div popover=""
                     id="link-for-delete-{{ $item->id }}"
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
                        Удалить новость?
                    </h3>
                    <hr>
                    <div class="p-4 flex flex-col gap-3">
                        @if($item->relation)
                            <div>
                                {!! $item->relation->name !!}
                            </div>
                        @endif
                        <div>
                            {!! $item->title !!}
                        </div>

                    </div>
                    <hr>
                    <div class="text-right px-4 py-2">

                        <form method="POST" action="{{ $item->cabinet_delete }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="удалить"
                                   class="
                                            cursor-pointer
                                            inline-block relative
                                            py-2 px-4 text-white rounded-md shadow-md
                                            shadow-gray-300
                                            bg-red-800 hover:bg-red-700 active:bg-gray-700
                                            hover:-mt-px hover:mb-px
                                       "
                            >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
