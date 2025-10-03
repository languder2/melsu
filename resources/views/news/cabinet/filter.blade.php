<form action="{{ route('news.cabinet.set-filter') }}" method="post"
    class="flex mb-3 gap-3 bg-white p-3"
>
    @csrf

    <x-form.select2
        id="form_division"
        name="setFilter[division]"
        value="{{ $filters->get('division') }}"
        null="Выбрать подразделение"
        :list=" $byFilter->get('divisions') "
    />


{{--    <x-form.checkbox.block--}}
{{--        id="onApproval"--}}
{{--        name="setFilter[onApproval]"--}}
{{--        :default="0"--}}
{{--        :value="1"--}}
{{--        label="Требует утверждения"--}}
{{--        :checked=" $filters->get('onApproval')"--}}
{{--        block="w-68"--}}
{{--    />--}}

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
