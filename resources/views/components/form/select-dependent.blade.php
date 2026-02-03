@if(!is_array($list))
    @php
        $list = json_decode($list)
    @endphp
@endif

@if(!is_array($relation))
    @php
        $relation = json_decode($relation)
    @endphp
@endif

@if(isset($label))
    <div class="mt-2 -mb-2">
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

    @class([
        'border-b border-dashed bg-none',
        'outline-0 w-full py-2 mt-2',
        'peer autofill:text-pink-800 appearance-auto ring-0',
        $class??""
    ])

    @disabled(@$disabled)
    @required(@$required)
>

    @if(isset($null))
        <option
            value=''
            @disabled(isset($nullDisabled))
            @selected(empty($old) && empty($value))
        >
            {{$null}}
        </option>
    @endif

    @foreach($list as $code=>$item)
        <option
            value="{{$code}}"

            @disabled(!$code)

            @selected(empty($old) && empty($value) && empty($code))
            @selected(empty($old) && !empty($value) && $value == $code)
            @selected(!empty($old) && $old == $code)

            {{--            @if(!empty($code) && isset($optionData[$code]) && is_array($optionData[$code]))--}}
            {{--                @foreach($optionData[$code] as $dc=>$data)--}}
            {{--                    data-{{$dc}}="{{$data}}"--}}
            {{--                @endforeach--}}
            {{--            @endif--}}
        >
            {{$item}}
        </option>
    @endforeach
</select>
