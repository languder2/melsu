<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CabinetCategoriesController extends Controller
{
    public function list(bool $onApproval = false): View
    {
        $list = DocumentCategory::whereNull('relation_id')->get();

        Cache::forever('documents.onApproval', $onApproval);

        return view('documents.cabinet.list', compact('list'));
    }

    public function form(DocumentCategory $current): View|RedirectResponse
    {
        return view('documents.cabinet.category-form', compact('current'));
    }

    public function save(Request $request, DocumentCategory $current): RedirectResponse
    {

        $form = $request->validate($current::validateRules(), $current->validateMessages());

        $current->fill($form)->save();

        $current->content('short')->fill(['content' => $request->get('short')])->save();

        $current->option('show_documents')->fill(['property' => $request->input('show_documents')])->save();

        if($request->input('in_accordion') && $request->input('accordion_prefix'))
            $current->setOptions([
                'in_accordion'      => $request->input('show_documents'),
                'accordion_prefix'  => $request->input('accordion_prefix')
            ]);

        else
            $current->removeOptions(['in_accordion','accordion_prefix']);

        $close      = $request->has('save-close');

        $onApproval = Cache::get('documents.onApproval', false);

        return !$close ? redirect()->back()
            : redirect()->route( $onApproval ? 'documents.cabinet.on-approval' : 'documents.cabinet.list');

    }

    public function delete(DocumentCategory $current): RedirectResponse
    {
        if($current->exists)
            $current->delete();

        $onApproval = Cache::get('documents.onApproval', false);

        return redirect()->route( $onApproval ? 'documents.cabinet.on-approval' : 'documents.cabinet.list');
    }



}
