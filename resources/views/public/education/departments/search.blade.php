<section class="container py-10">
    <form
        method="post"
        action="{{route('public:education:departments:filter:set')}}"
        onsubmit="return false;"
    >
        <div class="flex gap-4">
            <div class="flex-1">
                <x-form.theme1.input-search
                    name="search"
                    block="DepartmentsList"
                />
            </div>
            <x-form.theme1.alt-select
                id="filter_faculty"
                class="min-w-96"
                name="faculty"
                value="{{$filter?->faculty}}"
                base="Все факультеты"
                :list="$faculties"
            />
        </div>

    </form>

</section>
