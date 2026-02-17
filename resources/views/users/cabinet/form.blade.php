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
    <form action="{{ $user->save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
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

        <div class="p-3 bg-white flex gap-3 flex-col">
            <div class="flex-1">
                <x-form.input
                    name="lastname"
                    label="Фамилия"
                    :value=" old('lastname', $user->lastname)"
                    required
                />
            </div>

            <div class="flex-1">
                <x-form.input
                    name="firstname"
                    label="Имя"
                    :value=" old('firstname', $user->firstname)"
                    required
                />
            </div>

            <div class="flex-1">
                <x-form.input
                    name="middlename"
                    label="Отчество"
                    :value=" old('middlename', $user->middlename)"
                />
            </div>
        </div>

        <div class="p-3 bg-white flex gap-3 flex-col">
            <div class="flex-1">
                <x-form.input
                    type="email"
                    name="email"
                    label="Email"
                    :value=" old('email', $user->email)"
                    required
                />
            </div>

            @if(auth()->id() !== $user->id)
                <x-form.select2
                    name="role"
                    value="{{ old('role', $user->role ?? 'user') }}"
                    label="Роль"
                    :list=" $roles "
                    required
                />
            @endif
        </div>

        <div class="p-3 bg-white flex gap-3 flex-col">

            <div class="flex-1">
                <x-form.input
                    id="form_new_password"
                    type="password"
                    name="new_password"
                    label="Новый пароль"
                    autocomplete="new-password"
                />
            </div>

            <div class="flex-1">
                <x-form.input
                    id="form_new_password"
                    type="password"
                    name="retry_password"
                    label="Повторить пароль"
                    autocomplete="new-password"
                />
            </div>

        </div>

        <input type="hidden" id="divisionsSDA" name="divisions" value="{{ $user->divisions->pluck('id') }}">
    </form>

    @component('users.cabinet.access-divisions', [
        'list'     => $user->divisions,
    ])@endcomponent

    @component('users.cabinet.access-pages', [
        'list'     => $user->pages,
    ])@endcomponent

@endsection
