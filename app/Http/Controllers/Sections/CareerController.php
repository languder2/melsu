<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Sections\Career;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function ApiAdd():View
    {
        return view('admin.career.block',[
            'is_new'   => true
        ]);
    }
    public function ApiDelete(?Career $item):JsonResponse
    {
        $item->delete();

        return response()->json(
            [
                'message' => "Карьера удалена"
            ]);
    }
}
