<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use App\Models\Menu\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use PhpParser\Comment\Doc;

class DocumentsController extends Controller
{
    /* ADMIN */
    public function admin(string $field,string $direction):View
    {

        $list = DocumentCategory::orderBy('sort','desc')->get();

        $documents = Document::whereNull('category_id')->whereNull('parent_id')->whereNull('relation_id')
            ->orderBy($field,$direction)->get();

        return view('documents.admin.list', compact('list','field','direction','documents'));
    }
    public function form(Document $document):View
    {
        $categories     = DocumentCategory::orderBy('name')->get()->pluck('name', 'id');

        $category_id    = request('category_id') ?? null;
        $parent_id      = request('parent_id') ?? null;

        $sort       = 0;
        if($category_id || $parent_id){
            $sort   = Document::where('category_id', $category_id)->orderBy('sort','desc')->first()->sort ?? 0;
            $sort   = $sort >= 1000 ? null : $sort+10;
        }

        $documents      = Document::where('id', '!=', $document->id)
            ->whereNull('relation_id')
            ->orderBy('title')
            ->get()
            ->pluck('title', 'id');

        return view(
            'documents.admin.form',
            compact('document', 'categories', 'documents','category_id','parent_id','sort')
        );
    }
    public function save(Document $document):RedirectResponse
    {
        $form = request()->validate(Document::FormRules(),Document::FormMessage());

        if(request()->file('file'))
            Document::FileSave($form);

        $document->fill($form)->save();

        return redirect()->route('documents:admin:list');
    }
    public function delete(Document $document):RedirectResponse
    {
        $document->delete();

        return redirect()->back();
    }

    /* END ADMIN */

    public function public():View
    {
        $categories = DocumentCategory::getPublic();

        $menu       = Menu::where('code','university')->first();

        $depth      = 0;

        return view('documents.public.list', compact('categories','menu','depth'));
    }
}
