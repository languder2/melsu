@extends("layouts.cabinet")

@section(
    'title',
    __('common.Cabinet') ." → ". __('common.Users') ." → "
    .($user->exists ? $user->email : __("common.Add user"))
)

@section('content-header')
    @include('users.cabinet.menu')
@endsection

@section('top-menu')@endsection

@section('content')
    <form action="{{ route('users.cabinet.change-access', $user) }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-form.errors/>

        <div class="flex gap3 bg-white p-3 justify-between sticky top-0 z-50 shadow">
            <div class="flex items-center">
                {!! $user->exists ? "$user->email ($user->fio)" : __('common.Add user') !!}
            </div>

            <div class="flex items-center gap-3">
                <input
                    type="submit"
                    value="Сохранить"
                    class="
                        bg-sky-800
                        px-4 py-2
                        text-white
                        rounded-md
                        hover:bg-blue-700

                        active:bg-gray-700
                        cursor-pointer
                        uppercase
                    "
                >
                <input
                    type="submit"
                    name="save-close"
                    value="Сохранить и закрыть"
                    class="
                        uppercase
                        bg-sky-800
                        px-4 py-2
                        text-white
                        rounded-md
                        hover:bg-blue-700
                        active:bg-gray-700
                        cursor-pointer
                    "
                >
            </div>
        </div>

        <input type="hidden" name="id" value="{{ $user->id }}">

        @component('users.cabinet.access-divisions', [
            'list'     => $user->divisions,
        ])@endcomponent

        @component('users.cabinet.access-pages', [
            'list'     => $user->pages,
        ])@endcomponent

    </form>


@endsection
