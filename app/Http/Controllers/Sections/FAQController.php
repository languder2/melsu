<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Page\Content;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function ApiAdd(){
        return view('admin.faq.block',[
            'id'        => (int)microtime(true),
            'faq'          => null,
            'answer'    => true
        ]);
    }
    public function ApiDelete(?FAQ $item){

        $item->delete();

        return response()->json(
            [
                'message' => "Вопрос удален"
            ]);
    }
}
