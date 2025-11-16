<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Minor\Science;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScienceController extends Controller
{
    public function list(string $entity, int $entity_id, bool $onApproval = false): View
    {

        $instance   = Entities::instance($entity, $entity_id);

        $list       = $onApproval ? $instance->onApprovalScience : $instance->science;

        return view('science.cabinet.list', compact('list', 'instance'));
    }

    public function form(string $entity, int $entity_id, Science $science): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$science->exists)
            $science->relation()->associate($instance);

        return view('science.cabinet.form', compact('science', 'instance', 'entity'));
    }

    public function save(Request $request, string $entity, int $entity_id, Science $science): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$science->exists)
            $science->relation()->associate($instance);

        $form = $request->validate($science->validateRules(), $science->validateMessages());

        $science->fill($form)->save();

        $short = json_decode($request->input('short'));
        if(is_object($short) && isset($short->blocks) && count($short->blocks))
            $science->content('short')->fill(['content' => $request->input('short')])->save();

        $content = json_decode($request->input('content'));
        if(is_object($content) && isset($content->blocks) && count($content->blocks))
            $science->content('content')->fill(['content' => $request->input('content')])->save();

        if($request->file('image'))
            $science->image->saveImage($request->file('image'));

        return redirect()->to(
            $request->has('save-close')
                ? $instance->science_cabinet_list
                : $science->cabinet_form
        );
    }

    public function delete(string $entity, int $entity_id, Science $science): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($instance == $science->relation)
            $science->delete();

        return redirect()->to($instance->careers_cabinet_list);
    }

    public function changeSort(string $entity, int $entity_id, Science $science, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->science, $science, $direction);

        return redirect()->back();
    }
}
