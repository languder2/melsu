<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CabinetCategoriesController extends Controller
{
    public function list(): View
    {
        $list = DocumentCategory::whereNull('relation_id')->get();

        dd($list);

        Session::put('documents-category.after-save-route', 'documents.relation.list');

        return view('documents.relation.list', compact('list'));
    }


}
