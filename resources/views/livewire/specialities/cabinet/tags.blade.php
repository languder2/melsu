<div class="col-span-full flex gap-2 flex-wrap mt-1 pl-8">
    <button
        type="button"
        wire:click="$set('level', '{{ $this->level === $speciality->level->value ? null : $speciality->level->value }}')"
        class="
                            cursor-pointer inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-sm transition text-white
                            {{ $this->level === $speciality->level->value ? 'bg-sky-600' : 'bg-slate-700 hover:bg-amber-600' }}
                        "
    >
        {{ $speciality->level->label() }}
    </button>

    @foreach($speciality->recruitmentProfiles as $profile)
        <button
            type="button"
            wire:click="$set('form', '{{ $this->form === $profile->form->value ? null : $profile->form->value }}')"
            class="cursor-pointer inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-sm transition text-white
                {{ $this->form === $profile->form->value ? 'bg-sky-600 ' : 'bg-green-700 hover:bg-amber-600' }}
            "
        >
            {{ $profile->form->label() }}: {{ (int) $profile->placesByType('budget')->count }} | {{ (int) $profile->placesByType('contract')->count }}
        </button>
    @endforeach

    @foreach($speciality->divisions() as $item)
        <a href="{{ $division?->id === $item->id ? route('specialities.cabinet.list') : route('division.cabinet.specialities', $item) }}"
           class="inline-flex items-center gap-1 text-xs px-2 py-1s rounded-sm text-white
            {{ $division?->id === $item->id ? 'bg-sky-600' : 'bg-red-800 hover:bg-amber-600' }}"
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
