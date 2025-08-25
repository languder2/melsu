<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\News\News;
use App\Models\News\Category;
use Illuminate\Support\Collection;

class ApiNews extends Controller
{
    public function getCategories()
    {
        $list = Category::all();

        return $list->toArray();
    }

    public function getList(int $count = 10, int $offset = 0)
    {
        $list = News::whereNotNull('published_at')->orderBy('published_at', 'desc')->skip($offset)->take($count)->get()
            ->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'getNewsLink'   => route('api:news:get', $item),
                    'link'          => $item->link,
                    'title'         => $item->title,
                    'published_at'  => $item->published_at,
                    'image'         => asset($item->preview->src),
                    'category_id'   => $item->category,
                    'category_name' => $item->tag->name,
                    'short'         => $item->full,
                ];
            });

        return $list->toArray();
    }
    public function getCategory(int $category, int $count = 10, int $offset = 0)
    {
        $list = News::where('category',$category)
            ->whereNotNull('published_at')->orderBy('published_at', 'desc')->skip($offset)->take($count)->get()
            ->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'getNewsLink'   => route('api:news:get', $item),
                    'link'          => $item->link,
                    'title'         => $item->title,
                    'published_at'  => $item->published_at,
                    'image'         => asset($item->preview->src),
                    'category_id'   => $item->category,
                    'category_name' => $item->tag->name,
                    'short'         => $item->full,
                ];
            });

        return $list->toArray();
    }

    public function getNews(?News $item): ?array
    {
        return !$item->exists ? null :
            [
                'id'            => $item->id,
                'getNewsLink'   => route('api:news:get', $item),
                'link'          => $item->link,
                'title'         => $item->title,
                'published_at'  => $item->published_at,
                'image'         => asset($item->preview->src),
                'category_id'   => $item->category,
                'category_name' => $item->tag->name,
                'short'         => $item->full,
                'content'       => $item->news,
            ];
    }
    public function getListByDate($date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();

        $result = collect([]);

        $list = News::whereNotNull('published_at')->orderBy('published_at', 'desc')
            ->whereDate('published_at', $date)
            ->get();

        foreach ($list as $item) {
            $result->push([
                'title'         => $item->title,
                'getNewsLink'   => route('api:news:get', $item),
                'link'          => $item->link,
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
