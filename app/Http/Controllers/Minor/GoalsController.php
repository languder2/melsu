<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Minor\Goals;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function list(string $entity, int $entity_id, bool $onApproval = false): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list       = $onApproval ? $instance->onApprovalGoals : $instance->goals;

        return view('goals.cabinet.list', compact('list', 'instance'));
    }

    public function form(string $entity, int $entity_id, Goals $goal): View
    {
        $instance   = Entities::instance($entity, $entity_id);
        $entity     = Entities::tryFrom($entity);

        if(!$goal->exists)
            $goal->relation()->associate($instance);

        return view('goals.cabinet.form', compact('goal', 'instance', 'entity'));
    }

    public function save(Request $request, string $entity, int $entity_id, Goals $goal): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$goal->exists)
            $goal->relation()->associate($instance);

        $form = $request->validate($goal->validateRules(), $goal->validateMessages());

        $goal->fill($form)->save();

        $goal->content_record->fill(['content' => $form['content']])->save();

        return redirect()->to($request->has('save-close') ? $instance->goals_cabinet_list : $goal->cabinet_form);
    }

    public function delete(string $entity, int $entity_id, Goals $goal): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($instance == $goal->relation)
            $goal->delete();

        return redirect()->to($instance->goals_cabinet_list);
    }

    public function changeSort(string $entity, int $entity_id, Goals $goal, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        $key        = $instance->goals->search(fn($item) => $item->id === $goal->id);

        if($key === false)
            return redirect()->to($instance->goals_cabinet_list);

        $flip       = ($direction === 'up') ? $instance->goals->get($key - 1) : $instance->goals->get($key + 1);

        $goal->sort = $flip->sort;
        $flip->sort = $goal->getRawOriginal('sort');

        $goal->save();
        $flip->save();

        return redirect()->to($instance->goals_cabinet_list);
    }

}
