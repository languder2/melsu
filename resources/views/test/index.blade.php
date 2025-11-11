@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    @php
        $division = \App\Models\Division\Division::find(3);
    @endphp

    <div class="max-w-4xl mx-auto my-6">
        <x-divisions.structure
            :division="3"
            :before="[
            [
                'name' => 'Проректор по образовательной деятельности',
                'link' => 'https://melsu.ru/staffs/16',
            ],
            [
                'name' => 'Комиссия Ученого совета по образовательной деятельности'
            ]
        ]"
        >
        </x-divisions.structure>

    </div>

    <div class="grid gap-3 grid-cols-[repeat(10,auto)]">
        <div class="grid col-span-full grid-cols-subgrid bg-sky-800 text-white sticky top-41 rounded-sm p-3 mx-2 shadow">
            <div>
                position
            </div>
            <div>
                surname name patronymic
            </div>
            <div>
                date_birth
            </div>
            <div>
                phone
            </div>
        </div>

        @forelse($list as $item)
            <div class="grid col-span-full grid-cols-subgrid bg-white rounded-sm p-3 mx-2 shadow">
                <div>
                    {{ $item->position }}
                </div>
                <div>
                    {{ $item->surname }}
                    {{ $item->name }}
                    {{ $item->patronymic }}
                </div>
                <div>
                    {{ $item->date_birth->format('d.m.Y') }}
                </div>
                <div>
                    {{ $item->phone }}
                </div>
                <div>
                    {{ $item->snils }}
                </div>
            </div>
        @empty
            empty
        @endforelse
    </div>


@endsection

