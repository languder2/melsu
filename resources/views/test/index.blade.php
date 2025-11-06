@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

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
                    {{ $item->phone }}
                </div>
            </div>
        @empty
            empty
        @endforelse
    </div>

    <table class="w-full">
    @foreach($list as $item)
        <tr class="bg-white rounded-sm p-3 mx-2 shadow">
            <td>
                {{ $item->position }}
            </td>
            <td>
                {{ $item->surname }}
                {{ $item->name }}
                {{ $item->patronymic }}
            </td>
            <td>
                {{ $item->phone }}
            </td>
        </tr>
    @endforeach
    </table>
@endsection

