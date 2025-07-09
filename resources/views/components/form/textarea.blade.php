<div class="block relative mt-2">
    <textarea
        @if(isset($id))
            id="{{$id}}"
        @endif
        class="{{ $class ?? '' }}"
        name="{{$name}}"
        placeholder="{{ $placeholder ?? null }}"
    >{{ $value ?? null}}</textarea>
</div>
