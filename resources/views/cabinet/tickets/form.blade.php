@extends("layouts.cabinet")

@section('title', $ticket->id ? "Кабинет: Редактирование тикета: {$ticket->title}" : 'Кабинет: Создание тикета')

@section('instruction')
    @for($i=0;$i<9;$i++)
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus est sed porta scelerisque. Sed suscipit, arcu volutpat feugiat posuere, eros nisi tristique nibh, mollis vehicula lectus tortor eu purus. Donec ut tortor blandit, sagittis diam eget, suscipit eros. Quisque at magna neque. Nulla faucibus mi at nunc mattis placerat. Pellentesque quis augue quis elit tristique auctor. Integer varius est orci, vel egestas felis dictum nec. Phasellus porta ex sit amet turpis finibus, sed vestibulum nisl efficitur. Praesent ultrices diam enim. In ut tellus sed sem placerat sollicitudin. Donec quis mollis dolor. Etiam viverra, arcu cursus porttitor porttitor, diam nunc auctor nisl, quis placerat magna erat et odio. Phasellus feugiat turpis quis mollis lacinia. Sed ac orci et nisi venenatis pharetra ac non arcu.
        </p>
        <p>
            In a dapibus nulla. Aenean erat orci, egestas non orci at, varius tempus risus. Ut suscipit lorem magna, quis auctor leo molestie ac. Integer ut efficitur neque. Curabitur sollicitudin ipsum dolor, et tempus massa lacinia a. Donec efficitur egestas facilisis. Aliquam feugiat convallis arcu quis sollicitudin. Nullam eleifend iaculis sapien id scelerisque.
        </p>
        <p>
            In a dapibus nulla. Aenean erat orci, egestas non orci at, varius tempus risus. Ut suscipit lorem magna, quis auctor leo molestie ac. Integer ut efficitur neque. Curabitur sollicitudin ipsum dolor, et tempus massa lacinia a. Donec efficitur egestas facilisis. Aliquam feugiat convallis arcu quis sollicitudin. Nullam eleifend iaculis sapien id scelerisque.
        </p>
    @endfor
@endsection
@section('content')
    <x-head.tinymce-config/>
    <form
        action="{{ route('ticket:save',[$ticket->id ?? null]) }}"
        method="post"
        enctype="multipart/form-data"
        class="mt-4"
    >
        @csrf

        <input type="hidden" name="id" value="{{ $ticket->id ?? null }}">
        <h3
            class="
                font-semibold text-lg bg-blue text-white p-4 rounded-t-md bg-cover bg-[image:var(--bg-cabinet-header)]
            "
        >
            @if($ticket->id)
                Изменения тикета: {!! $ticket->title !!}
            @else
                Создание тикета
            @endif

        </h3>

        <div
            class="flex flex-col gap-4 py-4 bg-neutral-50 border-3 border-blue rounded-b-md"
        >
            @component('components.cabinet.form.input',[
                'name'          => 'title',
                'required'      => true,
                'value'         => old('_token') ? old('title') : $ticket->title,
                'blockClasses'  => "px-4",
                'inputClasses'  => "bg-white drop-shadow-xs",
            ])
                Заголовок*
            @endcomponent

            @component('components.cabinet.form.input',[
                'name'          => 'link',
                'value'         => old('_token') ? old('link') : $ticket->link,
                'blockClasses'  => "px-4",
                'inputClasses'  => "bg-white drop-shadow-xs",
            ])
                Ссылка (на страницу на которую будут вноситься правки)
            @endcomponent

            @component('components.cabinet.form.editor',[
                'name'          => 'content',
                'value'         => old('_token') ? old('content') : $ticket->content,
                'blockClasses'  => "px-4",
                'required'      => true,
            ])
                Описание*
            @endcomponent

            <x-ticket.select-manager />

            @component('components.cabinet.form.submit')
                Сохранить
            @endcomponent
        </div>

    </form>




@endsection
