<div
    id="tab_base"
    @class([
        "form_box",
        (!old('_token') || old('side_menu') === 'tab_base')?'':'hidden'
    ])
>
    <div class="bg-stone-50 p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Пользователь
        </div>
    </div>

    <div class="bg-stone-50 p-4 mb-4">

        <x-form.select
            id="form_role"
            name="role"
            old="{{old('role')}}"
            value="{{$user->role->value ?? 'user'}}"
            nullDisabled
            null="Выбрать"
            :list="$setRoleList"
            label="Роль"
            required
        />

        <div class="flex-1">
            <x-form.input
                id="form_email"
                name="email"
                label="Email"
                value="{!! old('_token') ? old('email') : $user->email ?? null !!}"
                required
            />
        </div>

        <div class="flex-1">
            <x-form.input
                id="form_name"
                name="name"
                label="Login"
                value="{!! old('_token') ? old('name') : $user->name ?? null !!}"
                required
            />
        </div>

        <div class="flex-1">
            <x-form.input
                id="form_lastname"
                name="lastname"
                label="Фамилия"
                value="{!! old('_token') ? old('lastname') : $user->lastname ?? null !!}"
                required
            />
        </div>

        <div class="flex-1">
            <x-form.input
                id="form_firstname"
                name="firstname"
                label="Имя"
                value="{!! old('_token') ? old('firstname') : $user->firstname ?? null !!}"
                required
            />
        </div>

        <div class="flex-1">
            <x-form.input
                id="form_middlename"
                name="middlename"
                label="Отчество"
                value="{!! old('_token') ? old('middlename') : $user->middlename ?? null !!}"
            />
        </div>

    </div>

    <div class="bg-stone-50 p-4 mb-4">
        <div class="flex-1">
            <x-form.input.password
                id="form_new_password"
                name="new_password"
                label="Новый пароль"
            />
        </div>

        <div class="flex-1">
            <x-form.input.password
                id="form_retry_password"
                name="retry_password"
                label="Повторить пароль"
            />
        </div>

    </div>

</div>
