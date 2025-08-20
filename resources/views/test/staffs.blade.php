@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <div class="p-4">Totals: {{ $list->count() }}</div>

    <div class="grid grid-cols-[auto_auto_1fr] gap-y-8 mx-4">
        @foreach($list as $fio => $items)
            <div class="flex items-center p-3 bg-blue text-white">
                {{ $loop->iteration }}
            </div>
            <div class="flex items-center p-3 bg-blue text-white">
                {{ $fio }}
            </div>
            <div class="grid grid-cols-[auto_1fr]">
                @forelse($items as $item)
                    <div class="flex items-center p-3 {{ $loop->index % 2 ? "bg-indigo-50" : "bg-white" }}">
                        <a href="{{ $item->form }}" class="underline hover:text-red-700" target="_blank">
                            {!! $item->id !!}
                        </a>
                    </div>
                    <div class="p-3 {{ $loop->index % 2 ? "bg-indigo-50" : "bg-white" }}">
                        <div class="grid grid-cols-[minmax(200px,500px)_1fr] gap-2 gap-x-4">
                            @forelse($item->affiliations as $post)
                                <div class="flex items-center">
                                    {!! $post->post !!}
                                </div>
                                <div>
                                    @if($post->relation->staffs_admin_list ?? null)
                                    <a
                                        href="{{ $post->relation->staffs_admin_list }}"
                                        class="underline hover:text-red-700"
                                        target="_blank"
                                    >
                                        {!! $post->relation->name !!}
                                    </a>
                                    @endif
                                </div>
                            @empty
                                <div class="col-span-2">
                                    Нет привязанных должностей
                                </div>
                            @endforelse
                        </div>
                    </div>
                @empty

                @endforelse
            </div>

        @endforeach
    </div>

@endsection

