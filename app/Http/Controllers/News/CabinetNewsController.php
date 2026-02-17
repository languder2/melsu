<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\Category;
use App\Models\News\News;
use App\Models\Users\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\View;


class CabinetNewsController extends Controller
{
    protected int $perPage = 40;
    protected Collection $divisions;
    protected array $divisionIDS;
    public function __construct(){

        if(auth()->user()->isEditor())
            $query = Division::query();
        else
            $query = auth()->user()->divisions();

        $this->divisions = flattenList($query->orderBy('name')->get());

        $this->divisionIDS = $this->divisions->pluck('id')->toArray();
    }
    public function list(bool $onApproval = false): View
    {
        $filter = Session::get('cabinetNewsFilters', collect());

        $query = News::query();

        if(!auth()->user()->isEditor() || $filter->has('division'))
            $query->whereIn('id', fn($query) =>
                $query->select('news_id')
                    ->from('news_relations')
                    ->where('relation_type', Division::class)
                    ->whereIn('relation_id',
                        $filter->has('division') ? [(int)$filter->get('division')] : $this->divisionIDS
                    )
            );

        if($filter->has('category'))
            $query->whereIn('id', fn($query) =>
                $query->select('news_id')
                    ->from('news_relations')
                    ->where('relation_type', Category::class)
                    ->where('relation_id', $filter->get('category'))
            );

        if($filter->has('author'))
            $query->where('author_id', $filter->get('author'));

        if($filter->has('search'))
            $query->where(fn($query) =>
                $query->where('id', $filter->get('search'))
                ->orWhere('title', 'like', '%'.Str::lower($filter->get('search')).'%')
            );

        if($onApproval)
            $query->where('has_approval', false);

        $query->orderBy('published_at', 'desc')->orderBy('id', 'desc');

        $list = $query->paginate($this->perPage);

        $authors = User::query();

        if(!auth()->user()->isEditor())
            $authors->whereIn('id', fn($query) =>
            $query->select('user_id')
                ->from('user_access')
                ->where('relation_type', Division::class)
                ->whereIn('relation_id', $this->divisionIDS)
            );

        $authors = $authors->orderBy('lastname')->orderBy('firstname')->orderBy('middlename')
            ->get()->each(fn($item) => $item->line = $item->fio . " ( $item->email )")
            ->pluck("line","id");

        $byFilter = collect([
            'divisions'     => $this->divisions->pluck('nameWithLevel', 'id'),
            'categories'    => Category::orderBy('name')->get()->pluck('name', 'id'),
            'authors'       => $authors,
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
        $divisions  = $this->divisions->pluck('nameWithLevel', 'id');

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
