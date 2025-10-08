<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\Category;
use App\Models\News\News;
use App\Models\News\RelationNews;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Http\Request;


class CabinetNewsController extends Controller
{

    protected Collection $divisions;
    protected int $perPage = 40;
    public function __construct(){
        $this->divisions =
            auth()->user()->isEditor()
            ? Division::all()
            : auth()->user()->access->map->relation;
    }
    public function list(Request $request): View
    {

        $list = auth()->user()->isEditor()
            ? News::all()->sortByDesc('published_at')
            : $this->divisions->flatMap(fn($division) => $division->news)->sortByDesc('published_at');

        $filters = $request->session()->get('cabinetNewsFilters', collect());

        if($filters->has('division'))
            $list= $list->where(fn($item)  => $item->relation_id == $filters->get('division') && $item->relation_type == Division::class);

        $list = $list->paginate($this->perPage);

//        $list->groupBy('relation_id')->map(fn($item) => $item->first() )->random(3)->each(function ($item){
//            $access = new UserAccess();
//            $access->user()->associate(auth()->user())->relation()->associate($item->relation)->save();
//        });

        $byFilter = collect([
            'divisions' => $this->divisions->pluck('name', 'id'),
        ]);

        $request->session()->put('cabinet-news-route', Route::current()->uri());

        return view('news.cabinet.list', compact('list', 'filters', 'byFilter'));
    }

    public function onApproval(Request $request): View
    {

        $list = auth()->user()->isEditor()
            ? News::all()->sortByDesc('published_at')
            : $this->divisions->flatMap(fn($division) => $division->news)->sortByDesc('published_at');

        $filters = $request->session()->get('cabinetNewsFilters', collect());

        if($filters->has('division'))
            $list= $list->where(fn($item)  => $item->relation_id == $filters->get('division') && $item->relation_type == Division::class);

        $byFilter = collect([
            'divisions' => $this->divisions->pluck('name', 'id'),
        ]);

        $list= $list->where(fn($item)  => !$item->has_approval)->paginate($this->perPage);

        $request->session()->put('cabinet-news-route', Route::current()->uri());

        return view('news.cabinet.list', compact('list', 'filters', 'byFilter'));
    }


    public function setFilter(Request $request): RedirectResponse
    {
        $filters = $request->collect('setFilter')->where(fn($item) => !empty($item));

        $request->session()->put('cabinetNewsFilters', $filters);

        return redirect()->route('news.cabinet.list');
    }

    public function form(News $news): View
    {
        $divisions  = $this->divisions->pluck('name', 'id');

        $categories = Category::all()->pluck('name', 'id');

        return view('news.cabinet.form', compact('news', 'divisions', 'categories'));
    }

    public function save(Request $request, News $news): RedirectResponse
    {

        $form = $request->validate($news->validateRules(), $news->validateMessage());

        $news->fill($form)->save();

        if(!$news->exists || !$news->author)
            $news->author()->associate(auth()->user())->save();


        if($request->filled('content'))
            $news->getContentRecord()->fill(['content'=> $request->get('content')])->save();

        if($request->filled('short'))
            $news->getShortRecord()->fill(['content'=> $request->get('short')])->save();

        if($request->filled('full'))
            $news->getFullRecord()->fill(['content'=> $request->get('full')])->save();

        if($request->input('division')){
            $division = Division::find($request->input('division'));

            $news->fill($form)->relation()->associate($division)->save();
        }

        if($request->file('image'))
            $news->preview->saveImage($request->file('image'));

        return redirect()->to( $request->has('save-close') ? $request->session()->get('cabinet-news-route') : $news->cabinet_form);
    }

    public function delete(News $news): RedirectResponse
    {
        $news->delete();
        return redirect()->route('news.cabinet.list');
    }

}
