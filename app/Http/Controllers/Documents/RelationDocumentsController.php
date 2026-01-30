<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RelationDocumentsController extends Controller
{
    public function relationList($entity, $entity_id): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list = $instance->documentCategories;

        Session::put('documents-category.after-save-route', 'documents.relation.list');

        return view('documents.relation.list', compact('list', 'instance') );
    }
    public function relationListOnApproval($entity, $entity_id): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list = $instance->documentCategories;

        Session::put('documents-category.after-save-route', 'documents-category.relation.on-approval');

        return view('documents.relation.list', compact('list', 'instance') );
    }

    public function relationCategoryForm($entity, $entity_id, DocumentCategory $category): View | RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($category->exists && !$instance->is($category->relation)) return redirect()->back();

        return view('documents.relation.category-form', compact('instance', 'category') );
    }

    public function relationCategorySave(Request $request, $entity,  $entity_id, DocumentCategory $category): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$category->exists)
            $category->relation()->associate($instance);

        if($category->exists && !$instance->is($category->relation)) return redirect()->back();

        $form = $request->validate($category::validateRules(), $category->validateMessages());

        $category->fill($form)->save();

        return $request->has('save-close')
            ? redirect()->route(
                Session::has('documents-category.after-save-route')
                ? Session::get('documents-category.after-save-route')
                : 'documents.relation.list',
                [$instance->getTable(), $instance, $category]
            )
            : redirect()->route('documents-category.relation.form', [$instance->getTable(), $instance, $category])
            ;

    }

    public function relationCategoryDelete($entity,  $entity_id, DocumentCategory $category): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        $user = auth()->user();

        if($category->relation->is($instance)&& ($instance->users->contains($user) || $user->isEditor()))
            $category->delete();

        return redirect()->back();
    }

    public function relationCategoryChangeSort(string $entity, int $entity_id, DocumentCategory $category, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->partnerCategories, $category, $direction);

        return redirect()->back();
    }

//    public function form(Request $request, $entity,  $entity_id, Partner $partner): View
//    {
//        $instance = Entities::instance($entity, $entity_id);
//
//        if(!$partner->exists){
//            $partner->relation()->associate($instance);
//            $partner->category_id = $request->input('category');
//        }
//
//        $categories = $instance->partnerCategories;
//
//        return view('partners.cabinet.form', compact('instance', 'partner', 'categories') );
//    }
//    public function save(Request $request, $entity,  $entity_id, Partner $partner): RedirectResponse
//    {
//        $instance   = Entities::instance($entity, $entity_id);
//
//        if(!$partner->exists)
//            $partner->relation()->associate($instance);
//
//        $form = $request->validate($partner->validateRules(), $partner->validateMessages());
//
//        $partner->fill($form)->save();
//
//        if($request->file('image'))
//            $partner->image->saveImage($request->file('image'));
//
//        $content = json_decode($request->input('content'));
//        if(is_object($content) && isset($content->blocks) && count($content->blocks))
//            $partner->content('content')->fill(['content' => $request->input('content')])->save();
//
//        return redirect()->to(
//            $request->has('save-close')
//                ? $instance->partnersCabinetList()
//                : $partner->form
//        );
//    }
//
//    public function changeSort(string $entity, int $entity_id, Partner $partner, $direction): RedirectResponse
//    {
//        $instance   = Entities::instance($entity, $entity_id);
//
//        flipSort( $partner->category ? $partner->category->partners : $instance->partners, $partner, $direction);
//
//        return redirect()->back();
//    }
//
//    public function delete(string $entity, int $entity_id, Partner $partner): RedirectResponse
//    {
//        $instance   = Entities::instance($entity, $entity_id);
//
//        if($partner->relation == $instance)
//            $partner->delete();
//
//        return redirect()->back();
//    }
}
