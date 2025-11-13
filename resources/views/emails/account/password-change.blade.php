<div style="background: #f0f0f0; padding: 20px;">
    <div style="background: white; max-width: 800px; margin: auto; padding: 20px; border-radius: 15px">
        <h3 style="margin-top: 0">
            Здравствуйте, {{$data->user->contact_name}}.
        </h3>
        <hr>
        <section style="font-size: 16px">
            <p>
                Изменен пароль на сайте <a href="{{url('cabinet')}}"> melsu.ru </a>.
            </p>

            <p style="font-weight: bolder"> Данные для входа: </p>

            <p>
                Email: {{$data->user->email}}
            </p>

            <p>
                Пароль: {{$data->password}}
            </p>
            <hr>
            <p style="text-align: center">
                Письмо сгенерировано автоматически и не требует ответа.
            </p>
            <p style="text-align: center">
                &copy; {{date("Y")}} ФГБОУ ВО "МелГУ"
            </p>
        </section>
    </div>
</div>
