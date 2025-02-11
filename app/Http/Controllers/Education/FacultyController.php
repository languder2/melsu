<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FacultyController extends Controller
{
    public function list(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.education')->with([
                    'active' => 'faculties'
                ])->render(),

                View::make('components.admin.education.faculties.header')->with([])->render(),

                View::make('components.admin.education.faculties.list')->with([
                    'list' => Faculty::all(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.education')->with([
                    'active' => 'faculties'
                ])->render(),

                View::make('components.admin.education.faculties.form')->with([
                    'current' => Faculty::find($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(Faculty::FormRules($request->get('id')), Faculty::FormMessage());

        if (empty($request->get('id')))
            $record = new Faculty();
        else
            $record = Faculty::find($request->get('id'));

        if(empty($form['order']))
            unset($form['order']);

        $record->fill($form);

        $record->save();

//        $image = $request->file('image');

//        $originalPath = $image->store('images/faculty');

        $manager = new ImageManager(new Driver());

        $image = $manager->read($request->file('image'));


//        dd(storage_path('images/faculties/123.jpg'));

        $image->save(storage_path('public/images/faculty/123.jpg'));

//        Storage::put('images/faculty/', $image->encode());
        dd(3);
//
//// resize image proportionally to 300px width
//        $image->scale(width: 300);
//
//
//// save modified image in new format
//        $image->toPng()->save('images/foo.png');

        dd(3);

        $image = $request->file('image');

        $originalPath = $image->store('public/images/faculty');
        $originalUrl = Storage::url($originalPath);

        $thumbnail = ImageManager::make($image)->resize(600);
        $thumbnailPath = 'public/images/thumbnails/' . $image->hashName();
        Storage::put($thumbnailPath, $thumbnail->encode()); // Сохраняем превью

        $thumbnailUrl = Storage::url($thumbnailPath);

//        if(!$record->logo)


        dump($thumbnailUrl,$originalUrl);

        dd($form);

        return redirect()->route('admin:education-faculty:list');
    }

    public function delete(int $id)
    {
        $record = Faculty::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education-faculty:list');
    }
}
