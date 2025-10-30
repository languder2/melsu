<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\Category;
use App\Models\News\Events;
use App\Models\News\News;
use App\Models\Users\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CabinetEventsController extends Controller
{
    protected Collection $divisions;
    protected Collection $accessUsers;
    protected int $perPage = 40;
    public function __construct(){
        $this->divisions =
            auth()->user()->isEditor()
            ? Division::all()
            : auth()->user()->access->map->relation;

        $this->accessUsers = auth()->user()->isEditor()
            ? User::orderBy('name')->get()->keyBy('id')
            : $this->divisions->flatMap(fn($item) => $item->getAccessUsers());

    }
    public function list(Request $request): View
    {
        $list = auth()->user()->isEditor()
            ? Events::all()->sortByDesc('published_at')
            : $this->divisions->flatMap(fn($division) => $division->events)->sortByDesc('published_at');

        $filter = Session::get('cabinetNewsFilters', collect());

        if($filter->has('search'))
            $list= $list->filter(fn($item)  =>
                $item->id == $filter->get('search') ||
                Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->title))
            );

        if($filter->has('author'))
            $list= $list->filter(fn($item)  => $item->author_id == $filter->get('author'));

        if($filter->has('division'))
            $list= $list->filter(fn($item)  =>
                $item->relation_id == $filter->get('division') && $item->relation_type == Division::class
            );

        $list = $list->paginate($this->perPage);

        $byFilter = collect([
            'divisions' => flattenTree($this->divisions)->keyBy('id')
                ->map(
                    fn ($item) =>
                        str_repeat('&nbsp;', $item->level*3)
                        . ($item->level ? __('common.arrowT2R')  : '' )
                        . $item->name
                ),
            'authors' => $this->accessUsers->pluck('name', 'id')
        ]);

        $request->session()->put('cabinet-news-route', Route::current()->uri());

        return view('events.cabinet.list', compact('list', 'byFilter'));
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
        if($request->has('clear'))
            Session::remove('cabinetNewsFilters');
        else
            Session::put('cabinetNewsFilters', $request->collect()->filter(fn($item) => !empty($item)));

        return redirect()->back();
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

    public function delete(Request $request, News $news): RedirectResponse
    {
        $news->delete();
        return redirect()->to($request->session()->get('cabinet-news-route') ?? route('news.cabinet.list'));
    }
}
