@props([
    'id'        => 'styled-select-' . \Illuminate\Support\Str::random(20),
    'label'     => "Добавить",
    'name'      => null,
    'list'      => collect(),
    'value'     => null,
    'default'   => "Выбрать",
    'required',
])


<div class="relative styled-select">
    <div
        id="{{ $id }}"
        class="w-full group relative p-3 bg-white shadow cursor-pointer outline-0"
        onclick="this.toggleAttribute(`open`)"
    >
        <div
            id="{{ $id }}-content"
        >
            {{ $list->has($value) ? $list->get($value) : $default }}
        </div>

        <div
            class="
                 mt-5
                absolute
                inset-x-0
                -z-5 opacity-0
                group-open:opacity-100
                max-h-0 peer-focus:max-h-100
                group-open:z-20
                duration-300 transition-opacity
            "
        >
            <div class="bg-white shadow">
            @foreach($list as $key=>$item)
                <label
                    class="
                        block p-3 cursor-pointer hover:bg-base-red hover:text-white
                        has-checked:bg-base-red has-checked:text-white
                    "
                >
                    <input
                        type="radio"
                        class="hidden"
                        name="{{ $name }}"
                        value="{{ $key }}"
                        onclick="
                            document.getElementById('{{ $id }}-content').textContent = '{{$item}}';
                            document.getElementById('{{ $id }}').toggleAttribute('open');
                        "
                        @checked($value === $key)

                        {{ $attributes }}
                    >
                    {{ $item }}
                </label>
            @endforeach
            </div>
        </div>

    </div>

</div>
