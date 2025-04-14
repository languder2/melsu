<?php

namespace App\Http\Controllers\News;

use App\Enums\EventType;
use App\Http\Controllers\Controller;
use App\Models\News\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EventsController extends Controller
{
    public function adminList(): \Illuminate\View\View
    {
        $last = Events::orderBy('id','desc')->first();

        dd($last->preview->src);
        return view('admin.events.events.list');
    }

    public function form(Events $event): string
    {

        $types = EventType::forSelect();

        return view('admin.events.events.form' , compact('event','types'));
    }

    public function save(Request $request, ?Events $event)
    {

        $form = $request->validate(Events::FormRules(), Events::FormMessage());

        $event->fill($form)->save();

        if(!$event->preview)
            $event->preview = $event->preview()->create([
                'name'          => $event->title,
                'type'          => 'preview',
            ]);

        if($request->file('image')){
            $event->preview->relation()->associate($event)->saveImage($request->file('image'));
        }
        elseif($form['preview']){
            $event->preview->name = $event->title;
            $event->preview->getReferenceID($form['preview']);
        }
        else{
            $event->preview->reference_id = null;
            $event->preview->filename = null;
            $event->preview->filetype = null;
        }

        $event->preview->save();

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
