<section class="border-x-2 border-x-base-red bg-white p-4 flex flex-row flex-wrap gap-3 justify-center text-lg text-base-red">
    <span open class="px-2 cursor-pointer hover:bg-neutral-200 open:bg-base-red open:text-white">
        Все
    </span>

    @foreach($letters as $letter)
        <span
            class="uppercase px-2 cursor-pointer hover:bg-neutral-100 open:bg-base-red open:text-white"
            onclick="Filters.byAttribute('regiment-member','letter','{{ $letter }}')"
        >
            {{ $letter }}
        </span>
    @endforeach

</section>
