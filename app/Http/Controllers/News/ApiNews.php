<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\News\News;
use App\Models\News\NewsCategory;

class ApiNews extends Controller
{
    public function getCategories()
    {
        $list = NewsCategory::all();

        return $list;
    }

    public function getList($count = 10)
    {

        $result = collect([]);

        $list = News::whereNotNull('published_at')->orderBy('published_at', 'desc')->limit($count)->get();

        foreach ($list as $item) {
            $result->push([
                'title'         => $item->title,
                'published_at'  => $item->published_at,
                'preview'       => asset($item->preview->src),
                'category_id'   => $item->category,
                'category_name' => $item->tag->name,
                'short'         => $item->full,
            ]);
        }

        return $result;
    }

    public function getListFrom(?string $date)
    {
        $date = Carbon::parse($date);

        dd($date->format('d-m-Y'));

        $result = collect([]);

        $list = News::whereNotNull('published_at')->orderBy('published_at', 'desc')->limit($count)->get();

        foreach ($list as $item) {
            $result->push([
                'title'         => $item->title,
                'published_at'  => $item->published_at,
                'preview'       => asset($item->preview->src),
                'category_id'   => $item->category,
                'category_name' => $item->tag->name,
                'short'         => $item->full,
            ]);
        }

        return $result;
    }


}
