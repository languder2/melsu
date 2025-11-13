<?php

namespace App\Http\Controllers\Partners;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Minor\Goals;
use App\Models\Partners\Category;
use App\Models\Partners\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CabinetPartnerController extends Controller
{
    public function list($entity, $entity_id): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list = $instance->partnerCategories;

        return view('partners.cabinet.list', compact('list', 'instance') );
    }

    public function categoryForm($entity, $entity_id, Category $category): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$category->exists)
            $category->relation()->associate($instance);

        return view('partners.cabinet.category-form', compact('instance', 'category') );
    }

    public function form(Partner $partner, $entity = null,  $entity_id = null): View
    {
        $instance   = Entities::instance($entity, $entity_id);
        $entity     = Entities::tryFrom($entity);

        $title = collect([
            __('admin.Admin panel'),
            $instance ? $instance->name : null,
            __('partners.Partners'),
        ])
            ->filter(fn($item) => $item)
            ->implode(__('common.arrowR'));

        return view('partners.admin.form', compact('title', 'entity', 'instance', 'partner') );
    }

    public function categorySave(Request $request, $entity,  $entity_id, Category $category): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$category->exists)
            $category->relation()->associate($instance);

        $form = $request->validate($category->validateRules(), $category->validateMessages());

        $category->fill($form)->save();

        return redirect()->to(
            $request->has('save-close')
                ? $instance->partnersCabinetList()
                : $category->cabinetForm()
        );
    }

    public function categoryChangeSort(string $entity, int $entity_id, Category $category, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->partnerCategories, $category, $direction);

        return redirect()->back();
    }

}
