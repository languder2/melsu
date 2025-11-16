<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Minor\Graduation;
use App\Models\Minor\Science;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GraduationController extends Controller
{
    public function list(string $entity, int $entity_id, bool $onApproval = false): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list       = $onApproval ? $instance->onApprovalGraduations : $instance->graduations;

        return view('graduations.cabinet.list', compact('list', 'instance'));
    }

    public function form(string $entity, int $entity_id, Graduation $graduation): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$graduation->exists)
            $graduation->relation()->associate($instance);

        return view('graduations.cabinet.form', compact('graduation', 'instance', 'entity'));
    }

    public function save(Request $request, string $entity, int $entity_id, Graduation $graduation): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$graduation->exists)
            $graduation->relation()->associate($instance);

        $form = $request->validate($graduation->validateRules(), $graduation->validateMessages());

        $graduation->fill($form)->save();

        $content = json_decode($request->input('content'));
        if(is_object($content) && isset($content->blocks) && count($content->blocks))
            $graduation->content('content')->fill(['content' => $request->input('content')])->save();

        if($request->file('image'))
            $graduation->image->saveImage($request->file('image'));

        return redirect()->to(
            $request->has('save-close')
                ? $instance->graduations_cabinet_list
                : $graduation->cabinet_form
        );
    }

    public function delete(string $entity, int $entity_id, Graduation $graduation): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($instance == $graduation->relation)
            $graduation->delete();

        return redirect()->back();
    }

    public function changeSort(string $entity, int $entity_id, Graduation $graduation, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->graduations, $graduation, $direction);

        return redirect()->back();
    }
}
