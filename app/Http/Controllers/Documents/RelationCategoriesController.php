<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RelationCategoriesController extends Controller
{
    public function list($entity, $entity_id): View
    {
        $instance = Entities::instance($entity, $entity_id);

        $list = $instance->documentCategories;

        Session::put('documents-category.after-save-route', 'documents.relation.list');

        return view('documents.relation.list', compact('list', 'instance'));
    }

    public function onApproval($entity, $entity_id): View
    {
        $instance = Entities::instance($entity, $entity_id);

        $list = $instance->documentCategories;

        Session::put('documents-category.after-save-route', 'documents-category.relation.on-approval');

        return view('documents.relation.list', compact('list', 'instance'));
    }

    public function form($entity, $entity_id, DocumentCategory $category): View|RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        if ($category->exists && !$instance->is($category->relation)) return redirect()->back();

        return view('documents.relation.category-form', compact('instance', 'category'));
    }

    public function save(Request $request, $entity, $entity_id, DocumentCategory $category): RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        if (!$category->exists)
            $category->relation()->associate($instance);

        if ($category->exists && !$instance->is($category->relation)) return redirect()->back();

        $form = $request->validate($category::validateRules(), $category->validateMessages());

        $category->fill($form)->save();

        return $request->has('save-close')
            ? redirect()->route(
                Session::has('documents-category.after-save-route')
                    ? Session::get('documents-category.after-save-route')
                    : 'documents.relation.list',
                [$instance->getTable(), $instance, $category]
            )
            : redirect()->route('documents-category.relation.form', [$instance->getTable(), $instance, $category]);

    }

    public function delete($entity, $entity_id, DocumentCategory $category): RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        $user = auth()->user();

        if ($category->relation->is($instance) && ($instance->users->contains($user) || $user->isEditor()))
            $category->delete();

        return redirect()->back();
    }

    public function changeSort(string $entity, int $entity_id, DocumentCategory $category, $direction): RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        flipSort($instance->documentCategories, $category, $direction);

        return redirect()->back();
    }

}
