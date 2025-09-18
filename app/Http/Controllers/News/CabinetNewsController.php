<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\RelationNews;
use App\Models\Services\Log;
use App\Models\Users\UserAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Http\Request;


class CabinetNewsController extends Controller
{

    protected Collection $divisions;

    public function __construct(){
        $this->divisions = auth()->user()->access->map->relation->pluck('name', 'id');
    }
    public function list(Request $request): View
    {

        $list = auth()->user()->access->flatMap(fn($access) => $access->relation->news)->sortByDesc('published_at');

        $filters = $request->session()->get('cabinetNewsFilters', collect());

        if($filters->has('division'))
            $list= $list->where(fn($item)  => $item->relation_id == $filters->get('division') && $item->relation_type == Division::class);

//        $list->groupBy('relation_id')->map(fn($item) => $item->first() )->random(3)->each(function ($item){
//            $access = new UserAccess();
//            $access->user()->associate(auth()->user())->relation()->associate($item->relation)->save();
//        });

        $byFilter = collect([
            'divisions' => auth()->user()->access->map->relation->pluck('name','id')
        ]);

        return view('news.cabinet.list', compact('list', 'filters', 'byFilter'));
    }

    public function setFilter(Request $request): RedirectResponse
    {
        $filters = $request->collect('setFilter')->where(fn($item) => !empty($item));

        $request->session()->put('cabinetNewsFilters', $filters);

        return redirect()->route('news.cabinet.list');
    }

    public function form(RelationNews $news): View
    {
        $divisions = $this->divisions;

        return view('news.cabinet.form', compact('news', 'divisions'));
    }

    public function save(Request $request, RelationNews $news): RedirectResponse
    {

        $division = Division::find($request->input('division'));

        $form = $request->validate($news->validateRules(), $news->validateMessage());

        if(!$news->exists)
            $news->author()->associate(auth()->user());

        $news->fill($form)->relation()->associate($division)->save();

        $news->getShortRecord()->fill(['type'=>'short', 'content' => $request->get('short')])->save();

        $news->getContentRecord()->fill(['type'=>'content', 'content' => $request->get('content')])->save();

        if($request->file('image')){
            $news->preview->saveImage($request->file('image'));
        }

        return redirect()->to( $request->has('save-close') ? route('news.cabinet.list') : $news->form);
    }

    public function delete(RelationNews $news): RedirectResponse
    {
        $news->delete();
        return redirect()->route('news.cabinet.list');
    }

}
