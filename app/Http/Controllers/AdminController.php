<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function login(Request $request): RedirectResponse
    {

        $form = (object)$request->validate(
            [
                "username" => "required",
                "password" => 'required',
                'remember' => ''
            ],
            [
                'username.required' => 'Укажите логин или email',
                'password.required' => 'Укажите пароль',
            ]
        );

        $user = User::where("name", $form->username)->orWhere("email", $form->username)->first();

        if (is_null($user))
            return redirect()->back()->withInput()->withErrors('Пользователь не найден');

        if (!password_verify($form->password, $user->password))
            return redirect()->back()->withInput()->withErrors('Неверный пароль');

        auth()->login($user, isset($form->remember));

        return redirect()->back();
    }
}
