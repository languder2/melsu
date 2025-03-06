<input
    type="submit"

    @if(isset($id))
        id="{{$id}}"
    @endif

    @if(isset($name))
        name="{{$name}}"
    @endif

    @if(isset($onclick))
        onclick="{{$onclick}}"
    @endif

    @if(isset($additional))
        @foreach($additional as $code=>$filed)
            data-{{$code}}="{{$filed}}"
    @endforeach
    @endif

    value="{{$value??"submit"}}"
    class="
                bg-blue-900
                px-4 py-2
                text-white
                rounded-md
                hover:bg-blue-700
                active:bg-gray-700
                {{@$class}}
            "
>
