<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\Category;
use App\Models\Services\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function admin():View
    {
        $list = Category::orderBy('sort')->orderBy('name')->get();

        return view('news.categories.admin.list', compact('list'));
    }
    public function form(?Category $category):View
    {
        return view('news.categories.admin.form', compact('category'));
    }
    public function save(Request $request, ?Category $category):RedirectResponse
    {

        $form = request()->validate($category->FormRules(),$category->FormMessage());

        $category->fill($form)->save();

        Log::add($category);

        return redirect()->to($category->admin);
    }

    public function delete(?Category $category):RedirectResponse
    {
        $category->delete();

        Log::add($category, 'delete');

        return redirect()->back();
    }

}
