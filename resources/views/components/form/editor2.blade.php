    @if(isset($borderTop))
    <hr class="mt-4 border-dotted">
@endif

@isset($label)
    <label for="{{$id}}" class="mb-2 block text-center font-semibold uppercase">
        @if(!isset($hideLabel))
            {{$label??$name}}@if(isset($required))
                *
            @endif
        @endif
    </label>
@endif

<textarea
    @if(isset($id))
        id="{{$id}}"
    @endif

    name="{{$name}}"

    @if(!isset($editor))
        class="{{@$class}}"
    @else
        class=""
    @endif

    @required($required ?? null)

    placeholder="Введите текст"


    @isset($height))
        style="height: {!! $height !!}"
    @endisset
>
    {!! @$value !!}
</textarea>

@if(isset($borderBottom))
    <hr class="mt-4 border-dotted">
@endif
