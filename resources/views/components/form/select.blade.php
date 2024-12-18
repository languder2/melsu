<label
    for         = "{{@$id}}"
>
    {{@$label}}
</label>
<select
    id          = "{{@$id}}"
    name        = "{{@$name}}"
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

            {{@$class}}
        "


    @disabled(@$disabled)
    @required(@$required)

    @if(!empty($datas) && is_array($datas))
        @foreach($datas as $code=>$data)
            data-{{$code}}="{{$data}}"
        @endforeach
    @endif

    @if(isset($dependents) and is_array($dependents))
        data-dependents='{!! json_encode($dependents) !!}'
    @endif
>

    @if(isset($null))
        <option
            value=''
            @disabled(isset($nullDisabled))
            @selected(empty($old) && empty($value))
        >
            {{$null}}@if(isset($required))* @endif
        </option>
    @endif
    @foreach($list as $code=>$item)
        <option
            value="{{$code}}"
            @disabled(!$code)
            @selected(empty($old) && empty($value) && empty($code))
            @selected(empty($old) && !empty($value) && $value == $code)
            @selected(!empty($old) && $old == $code)

            @if(!empty($code) && isset($optionData[$code]) && is_array($optionData[$code]))
                @foreach($optionData[$code] as $dc=>$data)
                    data-{{$dc}}="{{$data}}"
                @endforeach
            @endif
        >
            {{$item}}
        </option>
    @endforeach
</select>
