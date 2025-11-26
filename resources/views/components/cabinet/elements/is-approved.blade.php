@props([
    "object"    => new \App\Models\Services\Content(),
    'show'      => false,
])

@if(auth()->user()->isEditor() || $show)
    <x-form.checkbox.block
        id="is_approved"
        name="is_approved"
        :default="0"
        :value="1"
        label="Утвердить"
        :checked=" old('is_approved', $object->exists ? $object->is_approved : true)"
        block="pe-2"
    />
@else
    <input type="hidden" name="is_approved" value="0">
@endif
