<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\View\View;

class RelationDocumentsController extends Controller
{
    public function admin(Entities $model, int $id):View
    {
        $relation = $model->model()::find($id) ?? abort(404);

        return view('documents.relation.admin', compact('relation'));
    }

    public function formCategory(Entities $model, int $id, ?DocumentCategory $category):View
    {
        $relation = $model->model()::find($id) ?? abort(404);

        if($category->exists && $category->relation->id !== $relation->id)
            abort(402);

        if(!$category->exists){
            $last = $relation->documentCategories()->orderBy('sort','desc')->first();
            $category->sort =  $last ? $last->sort + 10 : 10;
        }

        return view('documents.relation.category-form', compact('relation', 'category'));
    }
}
