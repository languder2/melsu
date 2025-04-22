<section class="border-x-2 border-x-base-red bg-white p-4 flex flex-row flex-wrap gap-3 justify-center text-lg text-base-red">
    <span
        open
        data-letter=""
        class="filter-member-item px-2 cursor-pointer hover:bg-neutral-100 open:bg-base-red open:text-white"
        onclick="Filters.byAttribute('filter-member-item','regiment-member','letter','')"
    >
        Все
    </span>

    @foreach($letters as $letter)
        <span
            data-letter="{{ $letter }}"
            class="filter-member-item uppercase px-2 cursor-pointer hover:bg-neutral-100 open:bg-base-red open:text-white"
            onclick="Filters.byAttribute('filter-member-item','regiment-member','letter','{{ $letter }}')"
        >
            {{ $letter }}
        </span>
    @endforeach

</section>
