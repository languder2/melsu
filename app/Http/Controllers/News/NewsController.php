<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\{News\Category, News\News};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function adminList(): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('news.menu')->with([
                    'active' => 'news'
                ])->render(),

                View::make('components.admin.news.news')->with([
                    'list' => News::select('published_at','title','id')->orderBy('published_at','desc')->paginate(20),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('news.menu')->with([
                    'active' => 'news'
                ])->render(),

                View::make('components.admin.news.form')->with([
                    'categories' => Category::orderBy('name')->get()->pluck('name', 'id'),
                    'current' => News::find($id),

                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(News::$FormRules, News::$FormMessage);

        if (empty($request->get('id')))
            $news = new News();
        else
            $news = News::find($request->get('id'));

        if($request->get('short'))
            $news->getShortRecord()->fill(['content'=> $request->get('short')])->save();

        if($request->get('full'))
            $news->getFullRecord()->fill(['content'=> $request->get('full')])->save();

        if($request->get('content'))
            $news->getContentRecord()->fill(['content'=> $request->get('content')])->save();

        $news->fill($form);

        $news->save();

        if(!$news->preview)
            $news->preview = $news->preview()->create([
                'name'          => $news->title,
                'type'          => 'preview',
            ]);

        if($request->file('image')){
            $news->preview->relation()->associate($news)->saveImage($request->file('image'));
        }
        elseif($form['preview']){
            $news->preview->name = $news->title;
            $news->preview->getReferenceID($form['preview']);
        }
        else{
            $news->preview->reference_id = null;
            $news->preview->filename = null;
            $news->preview->filetype = null;
        }

        $news->preview->save();

        return redirect()->route('admin:news');
    }

    public function delete(int $id)
    {
        $record = News::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:news');
    }


    public function show($id): string|RedirectResponse
    {
        $news = News::find((int)$id);

        if (is_null($news))
            return redirect()->route('pages:main');

        if( !($news->has_approval && $news->is_show) && !auth()->check() )
            return redirect()->route('pages:main');


        $previousNews = News::where('id', '<', $news->id)->orderBy('id', 'desc')->first();

        $nextNews = News::where('id', '>', $news->id)->orderBy('id', 'asc')->first();

        return view('pages.page', [
            'title' => 'ФГБОУ ВО "МелГУ": ' . $news->title,
            'contents' => [
                View::make('components.public.news.news')->with([
                    'news' => $news,
                    'previousNews' => $previousNews,
                    'nextNews' => $nextNews,
                ])->render(),
            ]
        ]);
    }

    public function showAll(?Category $category): \Illuminate\View\View
    {

        $list = $category->exists ? $category->news() : News::getPublicList();

        $search = session('newsPublicSearch');

        if($search)
            $list= $list->where('title', 'like', '%' . $search . '%');

        $list= $list->paginate(15);

        $categories = Category::orderBy('sort')->orderBy('name')->get();

        return view('news.public.list', compact('list', 'category','categories','search'));
    }
    public function publicSetFilter(Request $request): RedirectResponse
    {
        if($request->get('search'))
            session()->put('newsPublicSearch',$request->get('search'));
        else
            session()->remove('newsPublicSearch');

        return redirect()->back();
    }
}
