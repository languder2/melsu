@props([
    'division' => New \App\Models\Division\Division()
])

<h2 class="font-bold text-xl md:text-3xl">
    {{ __("menu.{$division->type->value} about") }}
</h2>

{!! $division->content_html !!}
