<?php

namespace App\Http\Controllers;

use Diglactic\Breadcrumbs\Breadcrumbs;
use App\Models\{News, NewsCategory};
use App\Models\ImageStorage;
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

        $image = (object)$request->validate(ImageStorage::$FormRules, ImageStorage::$FormMessage);

        if (!isset($image->image))
            return redirect()->route('admin:news');

        $record->image = 'news-' . $record->id;

        $record->save();

        $image->image->storeAS('images/news', 'original.' . $image->image->extension(), 'public');

        ImageStorage::saveResizedImageToStorage('news', $image->image->path(), 'news-' . $record->id, [
            "600:600", '900:900', [1200, 1200]
        ]);

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

        return view('pages.page', [

//            'breadcrumbs' => Breadcrumbs::render('news-item',$news),
            'title' => 'ФГБОУ ВО "МелГУ": ' . $news->title,
            'contents' => [
                View::make('components.public.news.news')->with([
                    'news' => $news,
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
