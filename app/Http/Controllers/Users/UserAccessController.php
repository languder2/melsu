<?php

namespace App\Http\Controllers\Users;

use App\Enums\Entities;
use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Division\Division;
use App\Models\Users\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserAccessController extends Controller
{

    public function list(string $entity, int $entity_id): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list       = $instance->users;

        $users = User::roleOrders()->get();

        return view('users.access.list',compact('list', 'users', 'instance'));
    }

    public function save(Request $request, string $entity, int $entity_id): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        $instance->users()->sync($request->input('users'));

        return redirect()->back();

    }
}
