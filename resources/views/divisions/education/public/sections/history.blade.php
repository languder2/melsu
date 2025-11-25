@props([
    'division'  => New \App\Models\Division\Division(),
    'id'        => 'history-' . \Illuminate\Support\Str::random(20),
])
@if(!empty($division->history->render()))
    <div class="flex flex-col gap-6">
        <h2 class="font-bold text-xl md:text-3xl first-letter:uppercase">
            {{ __("common.{$division->type->value} history") }}
        </h2>

        <div id="{{ $id }}" class="flex flex-col gap-3 overflow-hidden duration-300 ease-linear max-h-80"
        >
            {!! $division->history->render() !!}
        </div>

        <div class="flex justify-end">
            <button
                type="button"
                class="
                    btnShowMore border border-neutral-300 py-3 px-5 font-semibold
                    hover:bg-red-700 hover:text-white duration-300 ease-linear cursor-pointer
                "
                data-for="{{ $id }}"
            >
                <span class="opacity-100 open:opacity-0">
                    Подробнее...
                </span>
            </button>
        </div>
    </div>
@endif
