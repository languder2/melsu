<?php

namespace App\Http\Controllers\News;

use App\Enums\EventType;
use App\Http\Controllers\Controller;
use App\Models\News\Events;
use App\Models\News\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function list(): View
    {
        $list= Events::orderBy('published_at','desc')->get();
        return view('news.events.admin.list',compact('list'));
    }

    public function form(Events $event): string
    {
        $types = EventType::forSelect();
    return view('news.events.admin.form', compact('event', 'types'))->render();
    }

    public function save(Request $request, ?Events $event)
    {

        $form = $request->validate(Events::FormRules(), Events::FormMessage());

        
        $form['published_at'] = now();

        $event->fill($form)->save();

        if(!$event->preview)
            $event->preview = $event->preview()->create([
                'name'          => $event->title,
                'type'          => 'preview',
            ]);

        if($request->file('image')){
            $event->preview->relation()->associate($event)->saveImage($request->file('image'));
        }
        elseif($request->has('preview')){
            $event->preview->name = $event->title;
            $event->preview->getReferenceID($request->has('preview'));
        }
        else{
            $event->preview->reference_id = null;
            $event->preview->filename = null;
            $event->preview->filetype = null;
        }

        $event->preview->save();

        return redirect()->route('admin:events');
    }

    public function delete(Events $event)
    {
        $event->delete();
        return redirect()->back();
    }

    public function all(Request $request): View
    {
        $list =  Events::orderBy('published_at', 'desc')
            ->select('id', 'title', 'short', 'full', 'published_at')
            ->paginate(13);

        return view('news.events.public.list',compact('list'));
    }
    public function show(?Events $event): View | RedirectResponse
    {
        if(!$event)
            return  redirect()->route('public:events:list');

        return view('news.events.public.show', compact('event'));
    }



}
