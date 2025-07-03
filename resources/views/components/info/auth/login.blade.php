<form name="auth" method="post" action="{{route('cabinet:auth')}}" class="flex flex-col gap-4 h-full">
    @csrf
    <h3
        class="font-semibold uppercase text-center"
    >
        Авторизация
    </h3>

    @component('components.cabinet.form.errors') @endcomponent

    @component('components.cabinet.form.input',[
        'name'      => 'email',
        'type'      => 'email',
        'required'  => true,
    ])
        Email:
    @endcomponent

    @component('components.cabinet.form.input',[
        'name'      => 'password',
        'type'      => 'password',
        'required'  => true,
    ])
        Password:
    @endcomponent

    <div class="flex-grow"></div>

    @component('components.cabinet.form.submit')
        Войти
    @endcomponent
</form>
