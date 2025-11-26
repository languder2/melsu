@props([
    "object"    => new \App\Models\Services\Content(),
    'hidden'    => false,
])

@if(!$hidden)
    <x-form.checkbox.block
        id="is_show"
        name="is_show"
        :default="0"
        :value="1"
        label="Опубликовать"
        :checked=" old('is_show', $object->exists ? $object->is_show : true)"
        block="pe-2"
    />
@else
    <input type="hidden" name="is_show" value="1">
@endif
