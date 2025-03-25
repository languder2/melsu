<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Sections\FAQ;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class FAQController extends Controller
{
    public function ApiAdd():View
    {
        return view('admin.faq.block',[
            'id'        => (int)microtime(true),
            'faq'          => null,
            'answer'    => true
        ]);
    }
    public function ApiDelete(?FAQ $item):JsonResponse
    {

        $item->delete();

        return response()->json(
            [
                'message' => "Вопрос удален"
            ]);
    }
}
