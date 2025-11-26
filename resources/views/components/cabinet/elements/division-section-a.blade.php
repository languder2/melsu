@props([
    'link'          => null,
    'lucide'        => null,
    'title'         => null,
    'isApproved'    => false,
    'options'       => null,
    'option'        => null,
])
@php
    if($options && $option)
        $isApproved = $options->has($option) ? (bool)$options->get($option) : true
@endphp
<a
    href="{{ $link }}"
    class="flex-end hover:text-green-700 relative"
    title="{{ $title. ($isApproved ? '. ' . __('common.In moderation') : '')  }}">

    {!! \Illuminate\Support\Facades\Blade::render("<x-lucide-$lucide class='w-6 " .($isApproved ? null : 'text-red-700'). "'/>") !!}

    @if((bool)$isApproved === false)
        <x-lucide-triangle-alert class="w-4 absolute -bottom-0.5 -right-1 text-red-700 bg-white" />
    @endif
</a>
