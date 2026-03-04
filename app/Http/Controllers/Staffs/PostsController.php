<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function list(Division $division, bool $onApproval = false, bool $isRemoved = false): View
    {
        Cache::put('postOnApproval', $onApproval, now()->addMinutes(30));

        Cache::put('postIsRemoved', $isRemoved, now()->addMinutes(30));

        $leaders    = $isRemoved ? $division->trashedLeaders :
                    ($onApproval ? $division->onApprovalLeaders : $division->publicLeaders);

        $staffs     = $isRemoved ? $division->trashedStaffs :
                    ($onApproval ? $division->onApprovalStaffs : $division->publicStaffs);

        return view('staffs.cabinet.list', compact('division', 'leaders', 'staffs'));
    }

    public function form(Division $division, Post $current): View
    {
        $staffs = Staff::orderByFullName()->get();

        if(!$current->exists)
            $current->fill(['is_head_of_division' => request('isLeader')]);

        return view('staffs.cabinet.form', compact('division','current', 'staffs'));
    }
    public function save(Request $request, Division $division, Post $current): RedirectResponse
    {
        $form = $request->validate($current->validateRules(), $current->validateMessages());

        $form['division_id'] = $division->id;

        $current->fill($form)->save();

        return $request->has('save')
            ? redirect()->back()
            : redirect()->route(Post::cabinetRouteName(), $division);
    }

    public function delete(Division $division, Post $current): RedirectResponse
    {
        $current->delete();

        return redirect()->route(Post::cabinetRouteName(), $division);
    }

    public function restore(Division $division, int $current = null): RedirectResponse
    {
        Post::onlyTrashed()->find($current)->restore();

        return redirect()->route(Post::cabinetRouteName(), $division);
    }

    public function sortedAZ(Division $division, string $type = null): RedirectResponse
    {

        $list = match($type){
            'leaders'   => $division->leaders,
            'staffs'    => $division->staffs,
            default     => $division->allStaff
        };

        setSort($list->sortBy('sort')->sortBy('fullname')->values());

        return redirect()->back();
    }

    public function changeSort(Division $division, Post $current, string $direction = 'down'): RedirectResponse
    {

        $list = $current->is_head_of_division ? $division->leaders : $division->staffs;

        flipSort($list, $current, $direction);

        return redirect()->back();
    }

}
