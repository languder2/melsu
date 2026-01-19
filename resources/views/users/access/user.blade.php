@props([
    'users'     => collect(),
    'currents'  => collect(),
    'level'     => 0,
    'id'        => 'form-division-' . \Illuminate\Support\Str::random(20),
    'parents'   => collect()
])
@foreach($users as $user)
    <label
        class="
                group grid grid-cols-[auto_auto_1fr_1fr] col-span-full bg-white shadow group select-none cursor-pointer rounded-sm
                hover:bg-sky-700 hover:text-white duration-200
                order-2 has-[:checked]:order-1
            "
    >
        <input type="checkbox" name="users[]" value="{{ $user->id }}" class="peer hidden"
            @checked( $currents->contains($user->id))

        >
        <span class="p-3">
            {{ $user->id }}
        </span>

        <span class="opacity-0 peer-checked:opacity-100 p-3">
                <x-lucide-check class="w-6 duration-200"/>
            </span>

        <span class="p-3 flex gap-3">
            {!! $user->email !!}
        </span>

        <span class="p-3 flex gap-3">
            {!! $user->fio !!}
        </span>

    </label>
@endforeach
