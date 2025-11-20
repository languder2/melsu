@props([
    'name'      => null,
    'image'     => null,
    'contacts'  => collect(),
    'mobile'    => false,
    'color'     => 'text-white',

])

@php
    if(is_null($image))
        $image = asset("img/faculties-headers/faculty-of-technical-sciences.webp");

    $phones     = $contacts->filter(fn($item) => $item->type === \App\Enums\ContactType::Phone);
    $emails     = $contacts->filter(fn($item) => $item->type === \App\Enums\ContactType::Email);
    $addresses  = $contacts->filter(fn($item) => $item->type === \App\Enums\ContactType::Address);

@endphp

@if( $contacts->isNotEmpty() )
    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-5 p-3 xl:p-0 flex-1 {{ $color }}">
        @if($phones->isNotEmpty() || $emails->isNotEmpty())
            <div class="text-2xl font-semibold col-span-full">
                Контакты
            </div>
        @endif

        @foreach($phones as $item)
            <div class="flex items-center gap-3">
                <div>
                    {!! $item->type->ico() !!}
                </div>
                {{ $item->content }}
            </div>
        @endforeach

        @foreach($emails as $item)
            <div class="flex items-center gap-3">
                <div>
                    {!! $item->type->ico() !!}
                </div>
                {{ $item->content }}
            </div>
        @endforeach

        @foreach($addresses as $item)

            @if($item->title)
                <div class="text-lg 2xl:text-xl font-semibold col-span-full">
                    {{ $item->title }}
                </div>
            @endif

            <div class="flex items-center gap-3 col-span-full">
                <div>
                    {!! $item->type->ico() !!}
                </div>
                {{ $item->content }}
            </div>
        @endforeach
    </div>
@endif
