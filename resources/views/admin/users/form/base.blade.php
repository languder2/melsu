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
                id="form_name"
                name="name"
                label="Login"
                value="{!! old('_token') ? old('name') : $user->name ?? null !!}"
                required
            />
        </div>

        <div class="flex-1">
            <x-form.input
                id="form_full_name"
                name="full_name"
                label="ФИО"
                value="{!! old('_token') ? old('full_name') : $user->full_name ?? null !!}"
                required
            />
        </div>

        <div class="flex-1">
            <x-form.input
                id="form_full_name"
                name="email"
                label="Email"
                value="{!! old('_token') ? old('email') : $user->email ?? null !!}"
                required
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
