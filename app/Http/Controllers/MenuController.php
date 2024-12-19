<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    public function list():string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.menu.header')->with([])->render(),

                View::make('components.admin.menu.menu')->with([
                    'list' => [],
                ])->render(),
            ]
        ]);

    }

    public function form()
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.menu.form')->with([
                    'current' => &$current,
                ])->render(),
            ]
        ]);

    }
}
