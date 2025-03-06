<section class="container py-10">
    <form
        method="post"
        action="{{route('public:education:departments:filter:set')}}"
        onsubmit="PublicAction.formSend(this,document.getElementById('DepartmentsList')); return false;"
    >
        <div class="flex gap-4">
            <div class="flex-1">
                <x-form.theme1.input-search
                    name="search"
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
