@extends("layouts.admin")

@section('title',  __('admin.Admin panel').": ".__('news.News categories'))

@section('top-menu')
    @include('news.menu')
@endsection


@section('content-header')
    @component('admin.components.content-header')

        {{ __('news.News categories') }}

        @slot('link')
            {{ route('news-categories:admin:form') }}
        @endslot
    @endcomponent
@endsection

@section('content')

    <div class="bg-white rounded-md p-4 mb-4">
        <div
            class="
                grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[auto_auto_1fr_1fr_auto]
            "
        >
            <div class="font-semibold">
                ID
            </div>

            <div class="font-semibold">
                Sort
            </div>

            <div class="font-semibold">
                Name
            </div>

            <div class="font-semibold">
                Link
            </div>

            <div></div>

            @foreach($list as $item)
                <div>
                    {{ $item->id }}
                </div>
                <div>
                    {{ $item->sort }}
                </div>
                <div>
                    <a href="{{ $item->edit ?? '#' }}" class="underline hover:text-red">
                        {{ $item->name }}
                    </a>
                </div>
                <div>
                    <a href="{{ $item->link }}" target="_blank" class="underline hover:text-red">
                        {{ $item->link }}
                    </a>
                </div>
                <div>
                    @component('admin.components.button-with-modal',[
                        'id'        => $item->id,
                        'ico'       => '<i class="fas fa-trash w-4 h-4"></i>',
                        'link'      => $item->delete ?? '#',
                        'question'  => __('news.Delete category question'),
                        'detail'    => $item->name,
                        'show_link' => $item->link,
                    ])@endcomponent
                </div>

                <hr class="md:col-span-5 last:hidden opacity-70">

            @endforeach
        </div>
    </div>
@endsection
