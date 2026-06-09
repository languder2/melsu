<div class="col-span-full flex gap-2 flex-wrap mt-1 pl-8">
    <button
        type="button"
        wire:click="$set('level', '{{ $this->level === $speciality->level->value ? null : $speciality->level->value }}')"
        class="
                            cursor-pointer inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-sm transition
                            {{ $this->level === $speciality->level->value ? 'bg-sky-600 text-white' : 'bg-amber-100 text-gray-800 hover:bg-amber-200' }}
                        "
    >
        {{ $speciality->level->label() }}
    </button>

    @foreach($speciality->recruitmentProfiles as $profile)
        <button
            type="button"
            wire:click="$set('form', '{{ $this->form === $profile->form->value ? null : $profile->form->value }}')"
            class="
                                    cursor-pointer inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-sm transition
                                    {{ $this->form === $profile->form->value ? 'bg-sky-600 text-white' : 'bg-red-100 text-gray-800 hover:bg-red-200' }}
                                "
        >
            {{ $profile->form->label() }}
        </button>
    @endforeach

    @foreach($speciality->divisions() as $item)
        <a href="{{ $division?->id === $item->id ? route('specialities.cabinet.list') : route('division.cabinet.specialities', $item) }}"
           class="
                                inline-flex items-center gap-1 text-xs px-2 py-1s rounded-sm
                                {{ $division?->id === $item->id ? 'bg-sky-600 text-white' : 'bg-indigo-100 text-gray-800 hover:bg-indigo-200' }}"
        >
            #{{ $item->id }} {{ $item->name }}
        </a>
    @endforeach

    @if($speciality->code)
        <span class="inline-flex items-center gap-1 text-xs px-2 py-1s rounded-sm bg-gray-100 text-gray-800">
            {{ $speciality->code }}
        </span>
    @endif

</div>
