@props([
    'name'      => null,
    'image'     => null,
    'contacts'  => collect(),
    'mobile'    => false,
])
@php
    if(is_null($image))
        $image = asset("img/faculties-headers/faculty-of-technical-sciences.webp");

    $phones     = $contacts->filter(fn($item) => $item->type === \App\Enums\ContactType::Phone);
    $emails     = $contacts->filter(fn($item) => $item->type === \App\Enums\ContactType::Email);
    $addresses  = $contacts->filter(fn($item) => $item->type === \App\Enums\ContactType::Address);

    $classes    = $mobile ? "grid xl:hidden" : "text-white hidden xl:grid";
@endphp
@if($contacts->isNotEmpty())
    <div class="{{ $classes }} grid-cols-2 gap-5 p-3 xl:p-0">
        @if($phones->isNotEmpty() || $emails->isNotEmpty())
            <div class="text-2xl font-semibold col-span-full">
                Контакты
            </div>
        @endif

        @foreach($phones as $item)
            <div class="flex items-center gap-3">
                {!! $item->type->ico() !!}
                {{ $item->content }}
            </div>
        @endforeach

        @foreach($emails as $item)
            <div class="flex items-center gap-3">
                {!! $item->type->ico() !!}
                {{ $item->content }}
            </div>
        @endforeach

        @foreach($addresses as $item)

            @if($item->title)
                <div class="text-lg 2xl:text-2xl font-semibold col-span-full">
                    {{ $item->title }}
                </div>
            @endif

            <div class="flex items-center gap-3 col-span-full">
                @if(!$mobile)
                    {!! $item->type->ico() !!}
                @endif
                {{ $item->content }}
            </div>
        @endforeach


    </div>
@endif
