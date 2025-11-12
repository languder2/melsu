@props([
    'divisions' => collect(),
    'currents'  => collect(),
    'level'     => 0,
    'id'        => 'form-division-' . \Illuminate\Support\Str::random(20),
    'parents'   => collect()
])
@foreach($divisions as $division)
    <label
        class="
                group grid grid-cols-[auto_1fr_auto] col-span-full bg-white shadow group select-none cursor-pointer rounded-sm
                hover:bg-sky-700 hover:text-white duration-200
            "
    >
        <input type="checkbox" name="divisions[]" value="{{ $division->id }}" class="peer hidden"
            data-parents="{{ $parents }}"
            @checked( $currents->contains($division->id))

        >

        <span class="opacity-0 peer-checked:opacity-100 p-3">
                <x-lucide-check class="w-6 duration-200"/>
            </span>

        <span class="p-3 flex gap-3">
                @if($level)
                {!! Str::repeat('&nbsp;', $level*3) . __('common.arrowT2R').Str::repeat('&nbsp;',1) !!}
            @endif
            {!! $division->name !!}
        </span>

        <span class="p-3">
            {{ $division->id }}
        </span>
    </label>

    @component('users.cabinet.division',[
        'divisions' => $division->subs,
        'currents'  => $currents,
        'level'     => $level + 1,
        'parents'   => $parents->merge($division->id)
    ])@endcomponent
@endforeach
