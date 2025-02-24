<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\ImageStorage;
use App\Models\News\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EventsController extends Controller
{
    public function adminList(): string
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.news')->with([
                    'active' => 'events'
                ])->render(),

                View::make('components.admin.events.events')->with([
                    'list' => Events::orderBy('publication_at', 'desc')->get(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.news')->with([
                    'active' => 'events'
                ])->render(),

                View::make('components.admin.events.form')->with([
                    'current' => Events::find($id),

                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {

        $form = $request->validate(Events::$FormRules, Events::$FormMessage);

        if (empty($request->get('id')))
            $record = new Events();
        else
            $record = Events::find($request->get('id'));

        $record->fill($form);

        $record->save();

        $image = (object)$request->validate(ImageStorage::$FormRules, ImageStorage::$FormMessage);

        if (!isset($image->image))
            return redirect()->route('admin:events');


        $record->image = 'event-' . $record->id;

        $record->save();

        $image->image->storeAS('images/events', 'original.' . $image->image->extension(), 'public');

        ImageStorage::saveResizedImageToStorage('events', $image->image->path(), 'event-' . $record->id, [
            "600:600", '900:900', [1200, 1200]
        ]);

        return redirect()->route('admin:events');
    }

    public function delete(int $id)
    {
        $record = Events::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:events');
    }

}
