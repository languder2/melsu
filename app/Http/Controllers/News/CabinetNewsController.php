<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\Category;
use App\Models\News\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;


class CabinetNewsController extends Controller
{

    protected int $perPage = 40;
    protected Collection $divisions;
    public function __construct(){
        $this->divisions = auth()->user()->isEditor() ? Division::all()
            : auth()->user()->access->flatMap(fn($item) => $item->relation->getFlattenTree())->keyBy('id');

    }
    public function list(bool $onApproval = false): View
    {
        $list = auth()->user()->isEditor()
            ? News::all()->sortByDesc('published_at')
            : $this->divisions
                ->flatMap(fn($division) => $division->news)->unique('id')
                ->sortByDesc('published_at');


        $filter = Session::get('cabinetNewsFilters', collect());

        if($filter->has('search'))
            $list= $list->filter(fn($item)  =>
                $item->id == $filter->get('search') ||
                Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->title))
            );

        if($filter->has('author'))
            $list= $list->where(fn($item)  => $item->author_id == $filter->get('author'));

        if($filter->has('division'))
            $list= $list->filter(fn($item)  =>
                $item->relation_id == $filter->get('division') && $item->relation_type == Division::class
            );

        if($onApproval)
            $list = $list->filter(fn($item) => !$item->has_approval);

        $list = $list->paginate($this->perPage);

        $byFilter = collect([
            'divisions' => flattenTreeForSelect($this->divisions),
            'authors'   =>
                $this->divisions
                ->flatMap(fn($division) => $division->news)
                ->unique('author_id')
                ->map(fn($item) => $item->author)
                ->pluck('name','id')
        ]);

        session()->put('cabinet-news-route', Route::current()->uri());


        return view('news.cabinet.list', compact('list', 'byFilter'));
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
        $divisions  = flattenTreeForSelect($this->divisions);

        $categories = Category::all()->pluck('name', 'id');

        return view('news.cabinet.form', compact('news', 'divisions', 'categories'));
    }

    public function save(Request $request, News $news): RedirectResponse
    {
        $form = $request->validate($news->validateRules(), $news->validateMessage());

        $news->fill($form)->save();

        if(!$news->exists || !$news->author)
            $news->author()->associate(auth()->user()->id)->save();

        if($request->filled('content'))
            $news->getContentRecord()->fill(['content'=> $request->get('content')])->save();

        if($request->filled('short'))
            $news->getShortRecord()->fill(['content'=> $request->get('short')])->save();

        if($request->filled('full'))
            $news->getFullRecord()->fill(['content'=> $request->get('full')])->save();

        if($request->input('divisions'))
            $news->divisions()->sync(
                collect(json_decode($request->input('divisions')))
            );

        if($request->input('categories'))
            $news->categories()->sync(
                collect(json_decode($request->input('categories')))
            );

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
