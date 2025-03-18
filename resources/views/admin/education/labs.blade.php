@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    @component('admin.education.header',[
        'link'  => route('admin:division:add'),
        'type'  => \App\Enums\DivisionType::Lab,
    ])
        @slot('title')
            Лаборатории
        @endslot
    @endcomponent
@endsection

@section('content')

    <div class="bg-white rounded-md p-4 mb-4">
        <div
            class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_80px_1fr_1fr_1fr_auto]
        "
        >
            <div class="font-semibold text-center">
                ID
            </div>

            <div class="font-semibold">
                Preview
            </div>

            <div class="font-semibold">
                Наименование
            </div>

            <div class="font-semibold">
                Alias
            </div>

            <div class="font-semibold">
                Affiliation
            </div>

            <div></div>

            @foreach($list as $item)
                <div class="text-center">
                    {{$item->id}}
                </div>

                <div>
                    <img
                        src="{{$item->preview->thumbnail}}"
                        alt="{{$item->preview->name}}"
                        class="
                        h-12
                        w-20
                        object-center object-contain
                    "
                    >
                </div>

                <div>
                    {{$item->name}}
                </div>

                <div>
                    {{$item->code}}
                </div>

                <div>
                    {{ optional($item->relation)->name }}
                </div>

                <div>
                    <div class="flex flex-row text-white w-full">
                        <div class="flex-none w-14">
                            <a
                                href="{{route('admin:division:edit',$item->id)}}"
                                class="
                                py-2 px-4 rounded-md
                                bg-gray-900
                                hover:bg-green-700
                                active:bg-green-950
                            "
                            >
                                <i class="far fa-edit w-4 h-4"></i>
                            </a>
                        </div>

                        <div class="flex-none w-14">
                            <a
                                href="{{route('admin:division:delete',$item->id)}}"
                                class="
                                py-2 px-4 rounded-md
                                bg-gray-900
                                hover:bg-red-700
                                active:bg-red-950
                            "
                            >
                                <i class="fas fa-trash w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <hr class="md:col-span-6 last:hidden">
            @endforeach
        </div>
    </div>


@endsection



