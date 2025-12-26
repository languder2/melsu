<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Minor\Career;
use App\Models\Minor\Goals;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function list(string $entity, int $entity_id, bool $onApproval = false): View
    {

        $instance   = Entities::instance($entity, $entity_id);

        $list       = $onApproval ? $instance->onApprovalCareers : $instance->careers;

        return view('careers.cabinet.list', compact('list', 'instance'));
    }

    public function form(string $entity, int $entity_id, Career $career): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$career->exists)
            $career->relation()->associate($instance);

        return view('careers.cabinet.form', compact('career', 'instance', 'entity'));
    }

    public function save(Request $request, string $entity, int $entity_id, Career $career): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$career->exists)
            $career->relation()->associate($instance);

        $form = $request->validate($career->validateRules(), $career->validateMessages());

        $career->fill($form)->save();

        $short = json_decode($request->input('short'));
        if(is_object($short) && isset($short->blocks) && count($short->blocks))
            $career->content('short')->fill(['content' => $request->input('short')])->save();

        $content = json_decode($request->input('content'));
        if(is_object($content) && isset($content->blocks) && count($content->blocks))
            $career->content('content')->fill(['content' => $request->input('content')])->save();

        if($request->file('image'))
            $career->image->saveImage($request->file('image'));

        return redirect()->to(
            $request->has('save-close')
                ? $instance->careers_cabinet_list
                : $career->cabinet_form
        );
    }

    public function delete(string $entity, int $entity_id, Career $career): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($instance == $career->relation)
            $career->delete();

        return redirect()->to($instance->careers_cabinet_list);
    }

    public function changeSort(string $entity, int $entity_id, Career $career, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->careers, $career, $direction);

        return redirect()->back();
    }

    public function changeApproved(string $entity, int $entity_id, string $range, string $action): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($range === "all"){
            $instance->careers->each(fn($item) =>
            $item->update([
                'is_show'       => $action === "set",
                'is_approved'   => $action === "set"
            ])
            );
        }

        return redirect()->back();
    }
}
