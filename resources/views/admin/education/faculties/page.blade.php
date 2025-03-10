@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    @include('admin.education.faculties.header')
@endsection

@section('content')

    <div class="flex flex-wrap gap-3">
        @foreach($list as $item)
            <div
                class="
                gallery-item
                relative rounded-lg
                transition-all duration-200
                hover:-mt-2px
                hover:mb-2px
                hover:drop-shadow-[3px_5px_5px_rgba(0,0,0,.5)]
                select-none
                min-w-20
                bg-gray-700
            "
            >
                <img
                    src="{{$item->logo->thumbnail}}"
                    alt="{{$item->name}}"
                    class="
                    h-96
                    relative rounded-lg
                    transition-all duration-300
                    object-contain
                "
                >

                <div
                    class="
                    absolute inset-0 end-0 flex flex-col
                    items-end
                "
                >
                    <div class="flex justify-between w-full">
                        <div class="m-3 mb-0">
                            <a
                                href="#"
                                class="
                                block bg-stone-100 p-1 w-[4ch]
                                rounded-lg text-center
                                hover:bg-blue-900 hover:text-white
                            "
                            >
                                {{$item->departments->count()}}
                            </a>
                        </div>
                        <x-html.blocks.check-button
                            onclick="Actions.ToggleShow(this,'{{route('gallery-toggle-show',$item->id)}}')"
                            :checked="$item->show"
                        >
                            <i class="fas fa-toggle-on hidden text-green-700 group-has-checked:block"></i>
                            <i class="fas fa-toggle-off block text-red-700 group-has-checked:hidden"></i>
                        </x-html.blocks.check-button>
                    </div>

                    <div class="flex justify-between w-full">

                        <div class="m-3 mb-0">
                            <a
                                href="#"
                                class="
                                inline-block bg-stone-100 p-1 w-[4ch]
                                rounded-lg text-center
                                hover:bg-blue-900 hover:text-white
                            "
                            >
                                {{$item->specialities->count()}}
                            </a>
                        </div>

                        <x-html.blocks.a-button
                            hoverColor="text-blue-700"
                            :href="route('admin:faculty:edit',$item->id)"
                        >
                            <i class="fas fa-pencil-alt"></i>
                        </x-html.blocks.a-button>

                    </div>


                    <span class="flex-grow-5"></span>

                    <x-html.blocks.a-button
                        hoverColor="text-red-700"
                        onclick="Actions.DeleteItem(this.closest('.gallery-item'),'{{route('gallery-delete',$item->id)}}')"
                        DeleteItem
                    >
                        <i class="fas fa-recycle"></i>
                    </x-html.blocks.a-button>


                    <x-html.blocks.bottom-header>
                        <div>
                            #{{$item->id}}
                        </div>

                        <div class="border-r border-r-stone-50/30"></div>

                        <div class="text-right flex-1">
                            {{$item->name}}
                        </div>
                    </x-html.blocks.bottom-header>
                </div>
            </div>
        @endforeach
    </div>


@endsection



