@if(is_string($list))
    @php
        $list = json_decode($list)
    @endphp
@endif

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

    onload="console.log('test')"


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

    @if(isset($collection))
        @foreach($list??[] as $item)
            <option
                value="{{$item->id}}"
                @disabled(!$item->id)
                @selected(empty($old) && empty($value) && empty($item->id))
                @selected(empty($old) && !empty($value) && $value == $item->id)
                @selected(!empty($old) && $old == $item->id)

            @if(isset($item->attrs) && is_array($item->attrs))
                @foreach($item->attrs as $attr=>$attrValue)
                    {!! "$attr='$attrValue'" !!}
                    @endforeach
                @endif
            >
                {{$item->name}}
            </option>
        @endforeach
    @else
        @foreach($list??[] as $code=>$item)
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
    @endif
</select>
