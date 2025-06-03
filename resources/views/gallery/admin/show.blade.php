@extends("layouts.admin")

@section('title', "Gallery")

@section('top-menu')
    @include('admin.gallery.menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        {!! $gallery->name !!}
        @slot('info')
            <div class="flex flex-col gap-2 text-center">
                <p class="font-semibold">
                    Код для вставки в контент:
                </p>

                <p>
                    <a
                        href="javascript:ClipBoard.copyTextToClipboard('image-gallery:{{ $gallery->code }}:end-gallery','Код вставки галереи скопирован\n{{ $gallery->code }}')"
                        title="скопировать в буфер обмена"
                        class="underline hover:text-blue-700 active:text-gray-700"
                    >
                        image-gallery:{{ $gallery->code }}:end-gallery
                    </a>
                </p>
            </div>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="flex flex-col gap-4">
        @component('gallery.images.admin.form-multi-upload',compact('gallery')) @endcomponent


{{--        @if($images->count())--}}
{{--            <h3 class="font-semibold text-2xl">--}}
{{--                Последние добавленные--}}
{{--            </h3>--}}
{{--            <div class="flex gap-4 flex-wrap">--}}
{{--                @foreach($images as $image)--}}
{{--                    @component('gallery.admin.image',compact('image')) @endcomponent--}}
{{--                @endforeach--}}
{{--                <div class="flex-auto h-80"></div>--}}
{{--            </div>--}}
{{--        @endif--}}

        <h3>
            Все
        </h3>
        <div class="flex gap-4 flex-wrap">

            @foreach($gallery->adminImages() as $image)
                @component('gallery.admin.image',compact('image')) @endcomponent
            @endforeach
        </div>


@endsection
