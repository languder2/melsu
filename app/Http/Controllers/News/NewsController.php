<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\{News\News, News\NewsCategory};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function adminList(): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.news')->with([
                    'active' => 'news'
                ])->render(),

                View::make('components.admin.news.news')->with([
                    'list' => News::getPaginate(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.news')->with([
                    'active' => 'news'
                ])->render(),

                View::make('components.admin.news.form')->with([
                    'categories' => NewsCategory::getListForSelect(),
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

    public function showAll()
    {
        $list = News::orderBy('publication_at', 'desc')
            ->select('id', 'title', 'short', 'full', 'publication_at', 'image', 'category')
            ->paginate(13);

        return view('pages.page', [

            'includes'    =>[
                'jquery',
                'data-picker',
            ],

            'breadcrumbs' => (object)[
                'view'      => 'news',
                'route'     => 'news',
                'element'   => null,
            ],

            'contents' => [
                View::make('components.news.all')->with([
                    'list' => $list,
                ])->render(),
            ]
        ]);
    }

}
