<form action="{{ route('news.cabinet.set-filter') }}" method="post"
    class="grid grid-cols-[1fr_repeat(1,auto)] mb-3 gap-3 bg-white p-3"
>
    @csrf

    <x-form.select2
        id="form_division"
        name="setFilter[division]"
        value="{{ $filters->get('division') }}"
        null="Выбрать подразделение"
        :list=" $byFilter->get('divisions') "
    />

    <div class="flex items-center">
        <button
            class="
                bg-blue-900
                px-4 py-2
                text-white
                rounded-md
                hover:bg-blue-700
                active:bg-gray-700
                cursor-pointer
            "
        >
            Вывести
        </button>
    </div>
</form>
