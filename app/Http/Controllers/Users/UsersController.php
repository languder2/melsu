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

        return view('users.cabinet.form',compact('user','roles'));
    }
    public function access(User $user): View|RedirectResponse
    {
        return view('users.cabinet.access',compact('user'));
    }

    public function save(Request $request, User $user):RedirectResponse
    {
        if(!$user->exists)
            $user->role = UserRoles::User;

        if(!(auth()->user()->role->level() > $user->role->level() || auth()->id() === $user->id))
            return redirect()->to( $user::cabinetList() );


        $message = collect();

        $form = $request->validate($user->validateRules(),$user->validateMessages());

        $form['name'] = $form['email'];

        $user->fill($form);

        if($user->isDirty())
            $message->push(__('messages.Info changes'));

        if($form['new_password']){
            $user->password = bcrypt($form['new_password']);
            $pass = $form['new_password'];

            $message->push(__('messages.Password changed'));

            if($user->exists)
                SendEmailJob::dispatch((object)[
                    "template"      => "emails.account.password-change",
                    "subject"       => "Пароль сменен",
                    "user"          => $user,
                    "password"      => $pass
                ]);
        }

        if(!$user->exists && empty($form['new_password'])) {
            $pass = (string)Str::uuid();
            $user->password = bcrypt($user->new_pass);
        }

        if(!$user->exists) {
            SendEmailJob::dispatch((object)[
                "template"      => "emails.account.registration",
                "subject"       => "Аккаунт создан",
                "user"          => $user,
                "password"      => $pass
            ]);
        }

        $user->fill($form)->save();

        if($request->has('divisions'))
            if(array_filter($user->divisions()->sync($request->divisions)))
                $message->push(__('messages.Access to divisions changed'));

        if($request->has('pages'))
            if(array_filter($user->pages()->sync($request->pages)))
                $message->push(__('messages.Access to pages changed'));

        return redirect()->to( $request->has('save-close') ? User::cabinetList() : $user->form)
            ->with([
                'message' => $message,
                'forUser' => "#$user->id | $user->email"
            ]);

    }
    public function changeAccess(Request $request, User $user):RedirectResponse
    {
        if(!$user->exists)
            $user->role = UserRoles::User;

        if(!(auth()->user()->role->level() > $user->role->level() || auth()->id() === $user->id))
            return redirect()->to( $user::cabinetList() );

        $user->divisions()->sync($request->input('divisions'));

        $user->pages()->sync($request->input('pages'));

        return $request->has('save-close') ? redirect()->to(User::cabinetList()) : redirect()->back();
    }

    public function delete(User $user):RedirectResponse
    {
        if(!(auth()->user()->role->level() > $user->role->level() || auth()->id() === $user->id))
            return redirect()->to( $user::cabinetList() );

        $user->delete();

        return redirect()->back()
            ->with([
                'message' => __('messages.Delete success'),
                'forUser' => "#$user->id | $user->email"
            ]);
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
