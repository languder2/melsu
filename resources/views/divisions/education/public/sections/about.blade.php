@props([
    'division' => New \App\Models\Division\Division()
])

<h2 class="font-bold text-xl md:text-3xl">О факультете</h2>

{!! $division->content_html !!}
