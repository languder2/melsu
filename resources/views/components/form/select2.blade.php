@if(isset($label))
    <div class="mt-1 -mb-2 text-xs">
        {{@$label}}@if(isset($required))
            *
        @endif
    </div>
@endif
<select
    id="{{@$id}}"
    name="{{@$name}}"

    @if(isset($onchange))
        onchange="{{$onchange}}"
    @endif

    @if(isset($onload))
        onload="{{$onload}}"
    @endif

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
            {{$item}}
        </option>
    @endforeach
</select>
