<form
    method="post"
    action="{!!route('public:division:search')!!}"
    onsubmit="return false;"
    class="mb-4 p-4 bg-white"
>
    @csrf
    <div class="flex gap-4">
        <div class="flex-1">
            <x-form.theme1.input-search
                name="search"
                class="bg-stone-50/50"
                block="UniversityStructure"
            />
        </div>
    </div>

</form>
