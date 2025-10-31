@props([
    'id'        => 'form-' . \Illuminate\Support\Str::random(20),
    'name'      => 'form-' . \Illuminate\Support\Str::random(20),
    'list'      => collect(),
    'value'     => null,
    'label'     => null,
    'required'  => false,

])
@if($label)
    <div class="mt-1 -mb-2 text-xs">
        {{ $label . ($required ? '*' : '') }}
    </div>
@endif
<select
    id="{{ $id }}"
    name="{{ $name }}"


    {{ $attributes->except('class') }}

    class="
            border-b
            border-dashed
            bg-none

            outline-0
            w-full
            py-2
            mt-2

            peer
            autofill:text-pink-800
            appearance-auto
            ring-0

            {{ $class ?? ''}}
        "


    @disabled($disabled ?? null)
    @required($required ?? null)
>

    @if(isset($null))
        <option
            value=''
            @disabled(isset($nullDisabled))
            @selected(empty($value))
        >
            {{$null}}
        </option>
    @endif

    @foreach($list as $code=>$item)
        <option
            value="{{$code}}"
            @disabled(!$code)
            @selected($value == $code)
        >
            {!! $item !!}
        </option>
    @endforeach
</select>
