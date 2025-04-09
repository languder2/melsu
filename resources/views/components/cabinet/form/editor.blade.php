<div class="{{$blockClasses ?? ""}}">
    @if($slot)
        <label >
            {{ $slot }}
        </label>
    @endif
    <textarea
        name="{{$name}}"
        class="editor"
        @required(isset($required))
        placeholder="Введите текст"

>
    {!! @$value !!}
</textarea>
</div>
