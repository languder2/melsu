<?php

namespace App\Http\Controllers\Users;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Division\Division;
use App\Models\Users\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UsersController extends Controller
{

    public function list():View
    {
        $list = User::roleOrders()->get();

        $filter = Session::get('usersCabinetFilter');

        if($filter && $filter->has('search'))
            $list = $list->filter(fn($item) =>
                $item->id == $filter->get('search')
                || Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->email))
                || Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->fio))
            );

        return view('users.cabinet.list',compact('list'));
    }

    public function form(User $user): View|RedirectResponse
    {
        if(!$user->exists)
            $user->role = UserRoles::User;

        if(!(auth()->user()->role->level() > $user->role->level() || auth()->id() === $user->id))
            return redirect()->to( $user::cabinetList() );

        $roles      = auth()->user()->role->forSelect();

        $divisions  = Division::whereNull('parent_id')->orderBy('name')->get();

        return view('users.cabinet.form',compact('user','roles', 'divisions'));
    }

    public function save(Request $request, User $user):RedirectResponse
    {
        if(!$user->exists)
            $user->role = UserRoles::User;

        if(!(auth()->user()->role->level() > $user->role->level() || auth()->id() === $user->id))
            return redirect()->to( $user::cabinetList() );

        $form = $request->validate($user->validateRules(),$user->validateMessages());

        $form['name'] = $form['email'];

        if(array_key_exists('new_password',$form) && $form['new_password']){
            $user->password = bcrypt($form['new_password']);

            SendEmailJob::dispatch((object)[
                "template"      => "emails.account.password-change",
                "subject"       => "Пароль сменен",
                "user"          => $user,
                "password"      => $form['new_password']
            ]);
        }

        $user->fill($form)->save();

        $user->divisions()->sync($request->input('divisions'));

        return redirect()->to(User::cabinetList());
    }

    public function delete(User $user):RedirectResponse
    {
        if(!(auth()->user()->role->level() > $user->role->level() || auth()->id() === $user->id))
            return redirect()->to( $user::cabinetList() );

        $user->delete();

        return redirect()->back();
    }

    public function setFilter(Request $request): RedirectResponse
    {

        if($request->has('clear'))
            Session::remove('usersCabinetFilter');
        else{
            $filter = collect($request->all());
            Session::put('usersCabinetFilter', $filter);
        }

        return redirect()->back();
    }

}
