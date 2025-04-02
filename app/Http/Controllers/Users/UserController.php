<?php

namespace App\Http\Controllers\Users;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function list():View
    {
        $list = User::get();
        return view('admin.users.list',compact('list'));
    }

    public function form(?User $user):View
    {
        $setRoleList    = auth()->user()->role->forSelect();

        return view('admin.users.form',compact('user','setRoleList'));
    }


    public function save(Request $request):RedirectResponse
    {
        $user = User::find($request->get('id')) ?? new User();

        if(Gate::denies('manage', $user))
            return redirect()->route('admin:users:list');

        $form = $request->validate($user->FormRules(),$user->FormMessage());

        if(array_key_exists('new_password',$form)){
            $user->password = bcrypt($form['new_password']);
        }

        $user->fill($form)->save();

        return redirect()->route('admin:users:list');
    }

    public function delete(User $user):RedirectResponse
    {
        if(Gate::denies('manage', $user))
            return redirect()->back();

        $user->delete();
        return redirect()->back();
    }
}
