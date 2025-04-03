<div style="background: #f0f0f0; padding: 20px;">
    <div style="background: white; max-width: 800px; margin: auto; padding: 20px; border-radius: 15px">
        <h3 style="margin-top: 0">
            Здравствуйте, {{$data->user->contact_name}}.
        </h3>
        <hr>
        <section style="font-size: 16px">
            <p>
                Нам нашем <a href="{{url(route("pages:main"))}}">сайте</a> у Вашего аккаунта сменился <b>пароль</b>.
            </p>

            <p>
                Ваш пароль: {{$data->password}}
            </p>

            <p>
                Если у Вас возникли вопросы или проблемы, пожалуйста, свяжитесь с нами:
                <a href="mailto:helpdo.ed@mgu-mlt.ru">
                    helpdo.ed@mgu-mlt.ru
                </a>
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
