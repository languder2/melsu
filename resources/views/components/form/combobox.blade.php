@props([
    'id'                => \Illuminate\Support\Str::random(20),
    'name'      => null,
    'list'      => collect(),
    'value'     => null,
    'default'   => 'Выбрать',
    'label'     => null,
    'jqSelect'  => 'jq-select2',
    'class'     => null,
    'block'     => null,
    'required'  => false,
])

<div class="{{ $block }} flex flex-col gap-3">

    @if($label)
        <h3 class="font-semibold">
            {{$label}}
        </h3>
    @endif

    <select
        id="{{ $id }}"
        class=" {{ $jqSelect }} {{ $class }}"
        name="{{ $name }}"
        @required($required)
    >
        <option value="">
            {{ $default }}
        </option>
        @foreach($list as $key => $val)
            <option
                value="{{ $key }}"
                @selected( $key == $value )
            >
                {!! $val !!}
            </option>
        @endforeach
    </select>
</div>
