    @if(isset($borderTop))
    <hr class="mt-4 border-dotted">
@endif

@if(isset($id))
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
        class="editor {{@$class}}"
    @else
        class=""
    @endif

    @required(@$required)
    placeholder="Введите текст"


    @if(isset($height))
        style="height: {!! $height !!}"
    @endif
>
    {!! @$value !!}
</textarea>

@if(isset($borderBottom))
    <hr class="mt-4 border-dotted">
@endif
