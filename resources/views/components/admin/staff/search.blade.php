<section class="mb-6 bg-stone-50 p-4 rounded-lg">
    <form action="{{route('admin:staff:filter:set')}}" method="post"
        class="flex gap-4"
    >
        @csrf
        <div class="flex-1">
            <input
                type="text"
                name="search"
                class="
                    outline-0 border
                    focus:shadow-md focus:shadow-stone-400/20
                    w-full
                    px-4 py-2 rounded-lg
                "
                value="{{$filter->search ?? null}}"
            >
        </div>

        <button class="cursor-pointer bg-stone-200 px-4 py-2 rounded-lg hover:bg-green-700 hover:text-white">
            <i class="fas fa-search"></i>
        </button>
    </form>
</section>
