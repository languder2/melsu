@extends("layouts.admin")

@section('content-header')
    @component('admin.components.content-header')
        Сотавить отчет по зарплатам
    @endcomponent
@endsection

@section('content')
    <form
        action="{{ route('import.finance.report') }}"
        method="post"
        enctype="multipart/form-data"
        class="mx-auto max-w-3xl p-4 bg-white flex gap-3"
    >
        @csrf

        <input
            type="file" name="file"
            class="flex-1 px-3 py-2 border"
            required
        >
        <input type="text" name="sheet" value="{{ old('_token') ? old('sheet') : null }}"
               class="px-3 py-2 border"
        >
        <input type="submit" value="Отправить"
            class="border px-4 bg-blue-900 text-white hover:bg-blue-700 cursor-pointer duration-300 active:bg-gray-700"
        >


    </form>


    <table>
        @foreach($result as $item)
            <tr>
                <td>
                    {!! $item->count !!}
                </td>
                <td>
                    {!! $item->amount !!}
                </td>
            </tr>
        @endforeach
    </table>


@endsection
