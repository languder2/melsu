@props([
    'division'      => new \App\Models\Division\Division(),
    'specialities'  => collect(),
    'profiles'      => collect(),
    'levels'        => collect(),
    'forms'         => collect(),
    'bases'         => collect(),
])

<div class="grid md:grid-cols-[1fr_2fr] gap-5">
    <div class="grid md:grid-cols-[1fr_2fr] items-center gap-5 px-2.5 py-2.5 md:px-0 bg-[#252525] relative md:col-span-2">
        <div>
            <input
                type="text"
                name="profiles-search"
                class="w-full p-3 bg-transparent border border-[#FFFFFF] outline-0 text-[#FFFFFF] h-[48px] specialities_filter"
                data-group=".education-profile"
                value=""
                placeholder="Поиск"
                data-filter-type="search"
                onkeyup="specialitiesSearch()"
            >
        </div>
        <div>
            <h2 class="font-bold text-3xl text-white">
                Направления подготовки
            </h2>
        </div>
        <div class="bg-[#252525] absolute hidden md:flex h-full w-full left-[-100%]">

        </div>
    </div>
</div>
<div class="grid xl:grid-cols-3 gap-5">
    <div>
        <div class="hidden md:grid grid-cols-1 h-fit pb-5 border-b border-[#CCCCCC]">
            <label
                class="
                        has-checked:bg-base-red has-checked:text-white duration-300
                        flex justify-start py-3 px-5 h-fit cursor-pointer
                    "
            >
                <input
                    type="radio"
                    name="speciality-level"
                    value="all"
                    class="hidden specialities_filter"
                    checked
                    data-filter-type="check"
                    onchange="specialitiesFilter()"
                >
                Все
            </label>

            @foreach($levels as $key => $level)
                <label
                    class="
                            has-checked:bg-base-red has-checked:text-white duration-300
                            flex justify-start py-3 px-5 h-fit cursor-pointer
                        "
                >
                    <input
                        type="radio"
                        name="speciality-level"
                        value="{{ $key }}"
                        class="hidden"
                        data-filter-type="check"
                        onchange="specialitiesFilter()"
                    >
                    {{ $level }}
                </label>
            @endforeach
        </div>

        <div class="grid grid-cols-2 gap-3 pt-3">
            <div>
                <x-form.styled-select
                    :list="$forms"
                    name="profiles-form"
                    value="full-time"
                    onchange="specialitiesFilter()"

                />

            </div>

            <div>
                <x-form.styled-select
                    :list="$bases"
                    name="profiles-basis"
                    value="budget"
                    onchange="specialitiesFilter()"
                />
            </div>
        </div>

    </div>
    @foreach($profiles as $profile)
        @forelse($profile->places as $place)
            <x-divisions.speciality
                :profile="$profile"
                :place="$place"
            />
        @empty

        <x-divisions.speciality
            :profile="$profile"
        />
        @endforelse
    @endforeach
</div>

