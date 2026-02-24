<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CabinetDocumentsController extends Controller
{

    public function form(Request $request, $entity, $entity_id, Document $document): View|RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        $category_id    = $request->integer('category') ?: null;
        $parent_id      = $request->integer('parent');
        $categories     = $instance->documentCategories;

        return view('documents.relation.form',
            compact('instance', 'document', 'categories', 'category_id', 'parent_id')
        );
    }

    public function save(Request $request, $entity, $entity_id, Document $document): View|RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        $form = request()->validate($document->validateRules(),$document->validateMessage());

        if(request()->file('file'))
            Document::FileSave($form);

        $document->relation()->associate($instance);

        $document->fill($form)->save();

        $document->setOption('link',$request->get('link'));

        $document->setContent('before',$request->get('before'));

        $document->setContent('after',$request->get('after'));

        return $request->has('save-close')
            ? redirect()->route(
                Session::has('documents-category.after-save-route')
                    ? Session::get('documents-category.after-save-route')
                    : 'documents.relation.list',
                [$instance->getTable(), $instance, $document]
            )
            : redirect()->route('documents.relation.form', [$instance->getTable(), $instance, $document]);

    }

    public function delete(Document $document): RedirectResponse
    {
        $document->delete();

        return redirect()->back();
    }

    public function changeSort(Document $document, $direction): RedirectResponse
    {
        if($document->parent)
            $list = $document->parent->subs;

        elseif($document->category)
            $list = $document->category->documents;
        else
            $list = $document->relation->documents;

        flipSort($list, $document, $direction);

        return redirect()->back();
    }


}
