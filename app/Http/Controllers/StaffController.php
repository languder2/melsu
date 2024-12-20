<?php

namespace App\Http\Controllers;

use App\Models\ImageStorage;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StaffController extends Controller
{
    public function adminList(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.staff.header')->with([])->render(),

                View::make('components.admin.staff.list')->with([
                    'list' => [],
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.staff.form')->with([
                    'current' => Staff::find($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {

        $form = $request->validate(Staff::$FormRules,Staff::$FormMessage);

        if (empty($request->get('id')))
            $record = new Staff();
        else
            $record = Staff::find($request->get('id'));

        $record->fill($form);

        $record->save();

        $photo = (object)$request->validate(
            ImageStorage::getValidateRules('photo'),
            ImageStorage::getValidateRules('photo')
        );


        if (!isset($photo->photo))
            return redirect()->route('admin:staff');

        else
            $photo = $photo->photo;


        $record->photo = 'photo-' . $record->id;

        $record->save();

        $photo->storeAS('images/photo', 'original.' . $photo->extension(), 'public');

        ImageStorage::saveResizedImageToStorage('photo', $photo->path(), 'photo-' . $record->id, [
            [200, 200],
            [600, 600],
            [800, 800],
            [1200, 1200],
        ]);

        return redirect()->route('admin:staff');
    }
}
