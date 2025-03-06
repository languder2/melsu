<div class="flex items-center h-screen">
    <form
        action="{{route('admin:login')}}"
        method="POST"
        class="max-w-(--breakpoint-md) min-w-[20rem] mx-auto h-auto bg-white rounded-md">
        @csrf
        <h3 class="text-lg font-semibold px-4 py-2 text-center">Авторизация</h3>
        <hr>
        <div class="px-4 py-2">

            <x-form.errors/>

            <x-form.input
                id="username"
                name="username"
                value="{{old('username')}}"
                label="Login or Email"
                required
            />

            <x-form.input
                id="password"
                type="password"
                name="password"
                label="Password"
                required
            />

        </div>
        <hr>
        <div class="text-right px-4 py-2">
            <x-form.btn-base
                text="Войти"
            />
        </div>
    </form>
</div>
