@extends("layouts.page")

@section('title', $division->meta['title'] ?? "ФГБОУ ВО «МелГУ»")

@section('meta')
    {{--    <x-common.meta :meta="$division->meta"/>--}}
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::view("vendor.breadcrumbs.base", 'educational-infrastructure') !!}
@endsection

@section('aside')
    {!!view('public.menu.aside-tree',['menu' => \App\Models\Menu\Menu::where('code', 'education')->first() ])!!}
@endsection

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 max-w-[1360px] mx-auto mb-6">
        @foreach($list as $item)
            <a
                href="{{ $item->link }}"
                class="hover:-mt-1 hover:mb-1 hover:shadow-md duration-300 text-base-red border border-gray-200 rounded-md bg-white shadow"
            >
                <div class="flex flex-col h-full">
                    <img
                        src="{{ $item->image('compilation')->src }}"
                        class="aspect-video rounded-t-md object-cover"
                        alt
                    >

                    <div class="flex-grow p-3 font-semibold flex items-center">
                        {{ $item->name }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
