@if(isset($borderTop))
    <hr class="mt-4 border-dotted">
@endif

@if(isset($id))
    <label for="{{$id}}" class="mb-2 mt-4 block text-center font-semibold uppercase text-xl">
        {{$label??$name}}@if(isset($required))*@endif
    </label>
@endif

<textarea
    @if(isset($id))
        id="{{$id}}"
    @endif

    name="{{$name}}"

    @if(!isset($editor))
        class="editor"
    @else
        class=""
    @endif

    @required(@$required)
    placeholder="Введите текст"
>
    {{@$value}}
</textarea>

@if(isset($borderBottom))
    <hr class="mt-4 border-dotted">
@endif
