<div class="relative shadow-md rounded-md overflow-hidden {{ $item->has_approval ? "" : "shadow-red-700" }}">
    <img src="{{ $item->preview->thumbnail }}" alt=""
         class="h-96 w-128 object-cover object-top"
    />
    <div
        class="
            absolute inset-3 flex flex-col gap-3
        "
    >
        <div class="
            p-3 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100
            {{ $item->has_approval ? "bg-indigo-200/55" : "bg-red-700/55 text-white" }}
        "
        >
            @if($item->relation)
                {!! $item->relation->name !!}
            @elseif($item->category)
                {!! $item->tag->name !!}
            @endif
        </div>

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
                {!! $item->published_at->format('d-m-Y') !!}
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
                <x-html.button-delete-with-modal
                    question="Удалить новость"
                    :action=" $item->cabinet_delete "
                    :text=" $item->title "
                    :relation=" $item->relation->name ?? null "
                />
            </div>
        </div>
    </div>
</div>
