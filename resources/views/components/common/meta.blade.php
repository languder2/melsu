@props([
    'meta' => collect()
])

@if($meta->has('keywords'))
    <meta name="keywords" content="{{ $meta->get('keywords') }}">
@endif
@if($meta->has('description'))
    <meta name="description" content="{{ $meta->get('keywords') }}">
@endif
@if($meta->has('og_title') || $meta->has('title'))
    <meta property="og:title" content="{{ $meta->get('og_title') ?? $meta->get('title') }}">
@endif
@if($meta->has('og_description') || $meta->has('description'))
    <meta property="og:description" content="{{ $meta->get('og_description') ?? $meta->get('description') }}">
@endif
@if($meta->has('og_site_name'))
    <meta property="og:site_name" content="{{ $meta->get('og_site_name')}}">
@endif
@if($meta->has('og_image'))
    <meta property="og:image" content="{{ $meta->get('og_image')}}">
@endif
<meta property="og:url" content="{{ Request::url() }}">
