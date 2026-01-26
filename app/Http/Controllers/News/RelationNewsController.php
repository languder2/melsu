<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\News\RelationNews;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RelationNewsController extends Controller
{
    public function show(RelationNews $news): View
    {
        $previousNews = News::where('id', '<', $news->id)->orderBy('id', 'desc')->first();

        $nextNews = News::where('id', '>', $news->id)->orderBy('id', 'asc')->first();

        return view('news.relation.news', compact('news', 'previousNews', 'nextNews'));
    }
}
