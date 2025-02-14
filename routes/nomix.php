<?php

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get("{page}",function(Request $request,$page){
    return view('pages.page', [
        'breadcrumbs' => (object)[
            'view'      => null,
            'route'     => 'staffs',
            'element'   => null,
        ],

        'contents' => [
            view()->exists("nomix.{$page}")?view("nomix.{$page}"):'no exist view',
        ]
    ]);
});

Route::get("inner/{page}",function(Request $request,$page){
    return view('pages.page-with-menu', [
        'breadcrumbs' => (object)[
            'view'      => null,
            'route'     => 'staffs',
            'element'   => null,
        ],

        'nobg'  => true,

        'menu'  => Menu::getMenuFromMain(route('public:staff:list')),

        'contents' => [
            view()->exists("nomix.{$page}")?view("nomix.{$page}"):'no exist view',
        ]
    ]);
});

Route::get("inner-with-bg/{page}",function(Request $request,$page){
    return view('pages.page-with-menu', [
        'breadcrumbs' => (object)[
            'view'      => null,
            'route'     => 'staffs',
            'element'   => null,
        ],

        'nobg'  => false,

        'menu' => Menu::getMenuFromMain(route('public:staff:list')),

        'contents' => [
            view()->exists("nomix.{$page}")?view("nomix.{$page}"):'no exist view',
        ]
    ]);
});

