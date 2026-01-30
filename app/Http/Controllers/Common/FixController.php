<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FixController extends Controller
{
    public function documentCategoriesSort():JsonResponse
    {

        $list = DocumentCategory::orderBy('sort')->get()
            ->groupBy(fn($item) => $item->parent_id ."_". $item->relation_type . '_' . $item->relation_id);

        $list->each(fn($items) =>
            $items->each(fn($item, $key) =>
                $item->update(['sort' => ($key+1)*100])
            )
        );

        return response()->json(['success']);
    }
}
