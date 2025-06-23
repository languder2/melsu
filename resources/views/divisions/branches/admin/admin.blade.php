@extends("layouts.admin")

@section('title', 'Админ панель: Факультеты')

@section('top-menu')
    @include('admin.education.menu')
@endsection

@section('content-header')
    @component('admin.education.header',[
        'link'  => route('admin:division:add'),
        'type'  => \App\Enums\DivisionType::Branch,
    ])
        @slot('title')
            Филиалы
        @endslot
    @endcomponent

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
                    src="{{$item->preview->thumbnail ?? null}}"
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
                    <x-html.blocks.check-button
                        onclick="Actions.ToggleShow(this,'{{$item->toggle_show}}')"
                        :checked="$item->show"
                    >
                        <i class="fas fa-toggle-on hidden text-green-700 group-has-checked:block"></i>
                        <i class="fas fa-toggle-off block text-red-700 group-has-checked:hidden"></i>
                    </x-html.blocks.check-button>

                    <x-html.blocks.a-button
                        hoverColor="text-blue-700"
                        :href="$item->edit"
                    >
                        <i class="fas fa-pencil-alt"></i>
                    </x-html.blocks.a-button>

                    <span class="flex-grow-5"></span>

                    <x-html.blocks.a-button
                        hoverColor="text-red-700"
                        onclick="Actions.DeleteItem(this.closest('.gallery-item'),'{{ $item->delete }}')"
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



