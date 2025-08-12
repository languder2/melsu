<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DocumentCategoriesController extends Controller
{
    /* ADMIN */
    public function admin(string $field,string $direction):View
    {
        $categories = DocumentCategory::whereNull('parent_id')->whereNull('relation_id')->orderBy($field,$direction)->get();

        return view('documents.categories.admin.list', compact('categories','field','direction'));
    }
    public function form(DocumentCategory $category):View
    {
        $sort   = DocumentCategory::orderBy('sort','desc')->first()->sort ?? 0;
        $sort   = $sort >= 1000 ? null : $sort+10;

        $list   = DocumentCategory::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name');

        if($category->relation)
            $list->where('relation_id',$category->relation_id)
                ->where('relation_type',$category->relation_type);

        $list   = $list->get()->pluck('name','id');

        return view('documents.categories.admin.form', compact('category', 'sort', 'list'));
    }
    public function save(DocumentCategory $category):RedirectResponse
    {

        $form = request()->validate(DocumentCategory::FormRules(),DocumentCategory::FormMessage());

        $category->fill($form)->save();

        return redirect()->route('document-categories:admin:list');
    }
    public function delete(DocumentCategory $category):RedirectResponse
    {
        $category->delete();

        return redirect()->back();
    }
    /* END ADMIN */

}
