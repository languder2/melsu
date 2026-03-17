@use(App\Models\Common\Tags)

@props([
    'hideLabel' => false,
    'multiple'  => false,
    'type'      => null,
    'name'      => 'tags',
    'size'      => 1,
    'tags'      => null,
    'selected'  => collect(),
    'withoutWrap'  => false
])

@php
    $tags = $tags ?? Tags::where('type', $type)->orderBy('name')->limit(1000)->pluck('name', 'id');
    $selected = collect(old($name, $selected->pluck('id')));
@endphp

@if(!$withoutWrap)
    <div class="flex flex-col gap-2 p-4 bg-white">

    @if(!$hideLabel)
        <p>{{ $slot->isNotEmpty() ? $slot : __("labels.Tags") }}</p>
    @endif
@endif

    <select
        class="tags"
        name="{{ $name }}[]"
        size="{{ $size }}"
        data-type="{{ $type }}"
        {{ $attributes->merge(['multiple' => (bool)$multiple]) }}
    >
        @foreach($tags as $tagId => $tag)
            <option value="{{ $tagId }}" @selected($selected->contains($tagId))>
                {{ $tag }}
            </option>
        @endforeach
    </select>

@if(!$withoutWrap)
    </div>
@endif
