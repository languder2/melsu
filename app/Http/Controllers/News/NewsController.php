<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Models\{Gallery\Gallery, News\News, News\Category};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\News\RelationNews;

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
            $record = new News();
        else
            $record = News::find($request->get('id'));

        $record->fill($form);

        $record->save();

        if(!$record->preview)
            $record->preview = $record->preview()->create([
                'name'          => $record->title,
                'type'          => 'preview',
            ]);

        if($request->file('image')){
            $record->preview->relation()->associate($record)->saveImage($request->file('image'));
        }
        elseif($form['preview']){
            $record->preview->name = $record->title;
            $record->preview->getReferenceID($form['preview']);
        }
        else{
            $record->preview->reference_id = null;
            $record->preview->filename = null;
            $record->preview->filetype = null;
        }

        $record->preview->save();

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
            $list= $list->where('title', 'like', '%' . $search . '%')
                    ->orWhere('news', 'like', '%' . $search . '%');

        $list= $list->paginate(13);

        $categories = Category::orderBy('sort')->orderBy('name')->get();

        return view('news.public.list', compact('list', 'category','categories','search'));
    }
    public function ApiAddSection():\Illuminate\View\View
    {
        $news   = new RelationNews();
        return view('news.admin.includes.block',compact('news'));
    }
    public function ApiDelete (?RelationNews $news): JsonResponse
    {
        $news->delete();
        return response()->json(
            [
                'message' => "Новость удалена\n{$news->title}\n Восстановимо до: "
                    .Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
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
