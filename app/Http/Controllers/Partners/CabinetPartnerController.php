<?php

namespace App\Http\Controllers\Partners;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
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

    public function categoryDelete($entity,  $entity_id, Category $category): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($category->relation == $instance)
            $category->delete();

        return redirect()->back();
    }

    public function categoryChangeSort(string $entity, int $entity_id, Category $category, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->partnerCategories, $category, $direction);

        return redirect()->back();
    }

    public function form(Request $request, $entity,  $entity_id, Partner $partner): View
    {
        $instance = Entities::instance($entity, $entity_id);

        if(!$partner->exists){
            $partner->relation()->associate($instance);
            $partner->category_id = $request->input('category');
        }

        $categories = $instance->partnerCategories;

        return view('partners.cabinet.form', compact('instance', 'partner', 'categories') );
    }
    public function save(Request $request, $entity,  $entity_id, Partner $partner): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$partner->exists)
            $partner->relation()->associate($instance);

        $form = $request->validate($partner->validateRules(), $partner->validateMessages());

        $partner->fill($form)->save();

        if($request->file('image'))
            $partner->image->saveImage($request->file('image'));

        $content = json_decode($request->input('content'));
        if(is_object($content) && isset($content->blocks))
            $partner->content('content')->fill(['content' => $request->input('content')])->save();

        return redirect()->to(
            $request->has('save-close')
                ? $instance->partnersCabinetList()
                : $partner->form
        );
    }

    public function changeSort(string $entity, int $entity_id, Partner $partner, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort( $partner->category ? $partner->category->partners : $instance->partners, $partner, $direction);

        return redirect()->back();
    }

    public function delete(string $entity, int $entity_id, Partner $partner): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($partner->relation == $instance)
            $partner->delete();

        return redirect()->back();
    }

}
