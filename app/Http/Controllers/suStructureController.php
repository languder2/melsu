<?php

namespace App\Http\Controllers;

use App\Models\Structure\suStructure;
use App\View\Components\Admin\structure\form as structureForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class suStructureController extends Controller
{
    public function adminList()
    {
        return view('pages.admin', [
            'contents' => [
                view('admin.structure.list', [
                    'list' => suStructure::getListByGroups(),
                ])->render(),
            ]
        ]);
    }

    public function form(?int $id = null)
    {

        if (!is_null($id))
            $current = suStructure::find($id);

        $contents = [];

        $form = new structureForm();


        $contents[] = $form->render()->with([
            'groups' => suStructure::getGroupsForSelect(),
            'form' => @$current,
        ]);

        return view('pages.admin', [
            'contents' => $contents
        ]);
    }

    public function save(Request $request): RedirectResponse
    {
        $form = $request->validate(suStructure::$FormRules, suStructure::$FormMessage);

        if (empty($form['sort'])) {
            $last = suStructure::where('ssu_group', $form['ssu_group'])->orderBy('sort', 'desc')->first();

            if (is_null($last))
                $form['sort'] = 10;

            else
                $form['sort'] = $last->sort + 10;
        }

        if (empty($request->get('id')))
            $record = new suStructure($form);
        else {
            $record = suStructure::find($request->get('id'));
            $record->fill($form);
        }

        $record->save();

        return redirect()->route('admin:structure');
    }

    public function delete(int $id): RedirectResponse
    {
        $record = suStructure::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:structure');
    }

    public function show()
    {

        return view('pages.page-with-menu', [
            'breadcrumbs' => View::make('components.template.breadcrumbs')->with([

            ])->render(),

            'nobg' => true,

            'contents' => [
                View::make('components.structure.page')->with([
                    'list' => suStructure::getListByGroups(),
                ])->render(),
            ]
        ]);

    }


}
