<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishTree;
class WishTreeController extends Controller
{

    public function save(Request $request)
    {
        $form = $request->validate(WishTree::$FormRules,WishTree::$FormMessage);

        WishTree::create($form);

        return redirect()->to('wish-tree?success=1');
    }

}
