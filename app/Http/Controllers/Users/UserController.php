<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function add()
    {
        User::create([
            'name' => 'ov3rfloyw',
            'email' => 'ov3rfloyw@yandex.ru',
            'password' => bcrypt('copyak0202A'),
        ]);
    }
}
