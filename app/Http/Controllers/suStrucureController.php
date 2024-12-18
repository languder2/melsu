<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\suStructure;
use App\View\Components\admin\structure\form as structureForm;


class suStrucureController extends Controller
{
    public function adminList()
    {
        return view('pages.admin',[
            'contents'  => [
                view('admin.structure.list',[
                    'list'          => suStructure::getListByGroups(),
                ])->render(),
            ]
        ]);
    }

    public function adminAdd()
    {
        $contents       = [];

        $form = new structureForm();
        $form->render()->with($form->data());

        $contents[]     = $form->render()->with([
            'test'      => 'test1'
        ]);

        return view('pages.admin',[
            'contents'  => $contents
        ]);
    }
}
