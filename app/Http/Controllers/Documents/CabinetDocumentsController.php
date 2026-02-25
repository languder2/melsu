<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CabinetDocumentsController extends Controller
{

    public function form(Request $request, Document $current): View|RedirectResponse
    {

        $category_id    = $request->integer('category') ?: null;
        $parent_id      = $request->integer('parent');
        $categories     = DocumentCategory::publicCustom();

        return view('documents.cabinet.form',compact('current', 'categories', 'category_id', 'parent_id'));
    }

    public function save(Request $request, Document $current): View|RedirectResponse
    {
        $form = request()->validate($current->validateRules(), $current->validateMessage());

        if(request()->file('file'))
            Document::FileSave($form);

        $current->fill($form)->save();

        $current->setOption('link',$request->get('link'));

        $current->setContent('before',$request->get('before'));

        $current->setContent('after',$request->get('after'));

        $close      = $request->has('save-close');

        $onApproval = Cache::get('documents.onApproval', false);

        return $close
            ? redirect()->route( $onApproval ? 'documents.cabinet.on-approval' : 'documents.cabinet.list')
            : redirect()->route( 'documents.cabinet.form', $current);
    }

    public function delete(Document $current): RedirectResponse
    {
        $current->delete();

        return redirect()->back();
    }

    public function changeSort(Document $current, $direction): RedirectResponse
    {
        if($current->parent)
            $list = $current->parent->subs;

        elseif($current->category)
            $list = $current->category->documents;
        else
            $list = $current->relation->documents;

        flipSort($list, $current, $direction);

        return redirect()->back();
    }


}
