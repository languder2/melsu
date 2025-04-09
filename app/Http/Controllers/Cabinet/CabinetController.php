<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function index()
    {
        return view('cabinet.index');
    }

    public function login(Request $request):RedirectResponse
    {
        $user = User::where("name", $request->get('username'))
            ->orWhere("email", $request->get('email'))
            ->first();

        if (is_null($user))
            return redirect()->back()->withErrors('Пользователь не найден');

        if (!password_verify($request->get('password'), $user->password))
            return redirect()->back()->withErrors('Неверный пароль');

        auth()->login($user);

        return redirect()->back();
    }

}
