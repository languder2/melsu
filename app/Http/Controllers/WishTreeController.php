<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\WishTree;
use Illuminate\Support\Facades\View;

class WishTreeController extends Controller
{

    public function save(Request $request)
    {
        $form = $request->validate(WishTree::$FormRules,WishTree::$FormMessage);

        WishTree::create($form);

        return redirect()->to('wish-tree?success=1');
    }
    public function list(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.wish-tree.list')->with([
                    'list' => WishTree::orderBy('id','desc')->paginate(20),
                ])->render(),
            ]
        ]);
    }


}
