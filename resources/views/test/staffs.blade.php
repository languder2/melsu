@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')


    <p><a class="hover:underline hover:text-base-red" href="../../../staffs/16">Проректор по образовательной деятельности</a></p>
    <ul>
        <li>Комиссия Ученого совета по образовательной деятельности</li>
        <li><a href="../../../division/departament_3">Департамент образовательной деятельности</a>
            <ul>
                <li>Учебно-методическое управление
                    <ul>
                        <li><a href="../../../division/educational-and-organizational-department">Учебно-организационный отдел</a></li>
                        <li><a href="../../../division/department-for-work-with-spo">Отдел по работе с СПО</a></li>
                        <li><a href="../../../division/department-of-Innovative-educational-technologies">Отдел инновационных образовательных технологий</a></li>
                    </ul>
                </li>
                <li>Управление развития и продвижения образовательных программ
                    <ul>
                        <li><a href="../../../division/11">Отдел лицензирования и аккредитации</a></li>
                        <li><a href="../../../division/9">Отдел менеджмента качества образования</a></li>
                        <li><a href="../../../division/147">Отдел продвижения образовательных программ</a></li>
                    </ul>
                </li>
                <li><a href="../../../division/institute-of-continuing-education">Институт непрерывного образования</a>
                    <ul>
                        <li><a href="../../../division/center-of-additional-education">Центр дополнительного образования и повышения квалификации</a></li>
                        <li>Отдел довузовской подготовки</li>
                        <li>Подготовительное отделение для иностранных граждан</li>
                    </ul>
                </li>
                <li><a href="../../../division/24">Научная библиотека</a></li>
                <li><a href="../../../accessible-environment">РУМЦ</a></li>
                <li><a href="../../../division/testing-center-for-foreign-citizens">Центр тестирования иностранных граждан</a></li>
            </ul>
        </li>
    </ul>

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

