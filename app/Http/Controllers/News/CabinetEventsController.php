<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\EventCategories;
use App\Models\News\Events;
use App\Models\Users\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CabinetEventsController extends Controller
{
    protected int $perPage = 50;
    protected Collection $allDivisions;
    protected Collection $divisions;
    protected Collection $ids;
    public function __construct(){

        $this->allDivisions = Division::all();

        $this->ids = auth()->user()->isEditor() ? collect() : auth()->user()->access->map->relation->pluck('id','id');

        $this->divisions = auth()->user()->isEditor()
            ? $this->allDivisions
            : $this->allDivisions->filter(fn($item) => $this->ids->has($item->id))->keyBy('id');

        $this->accessUsers = User::orderBy('name')->get()->keyBy('id');

        if(!auth()->user()->isEditor())
            $this->accessUsers = $this->divisions
                ->filter(fn($item) => $this->ids->has($item->id))
                ->flatMap(fn($item) => $item->getAccessUsers());
    }
    public function list(Request $request): View
    {
        $list = auth()->user()->isEditor()
            ? Events::orderBy('event_datetime', 'desc')->get()
            : $this->divisions->flatMap(fn($division) => $division->events)->sortByDesc('event_datetime');

        $filter = Session::get('cabinetNewsFilters', collect());

        if($filter->has('search'))
            $list= $list->filter(fn($item)  =>
                $item->id == $filter->get('search') ||
                Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->title))
            );

        if($filter->has('author'))
            $list= $list->filter(fn($item)  => $item->author_id == $filter->get('author'));

        if($filter->has('division'))
            $list= $list->filter(fn($item)  =>
                $item->relation_id == $filter->get('division') && $item->relation_type == Division::class
            );

        $list = $list->paginate($this->perPage);

        $byFilter = collect([
            'divisions' => flattenTreeForSelect($this->allDivisions, $this->ids->toArray()),
            'authors' => $this->accessUsers->pluck('name', 'id')
        ]);

        $request->session()->put('cabinet-events-route', Route::current()->uri());

        return view('events.cabinet.list', compact('list', 'byFilter'));
    }

    public function onApproval(Request $request): View
    {
        $list = auth()->user()->isEditor()
            ? Events::orderBy('event_datetime', 'desc')->get()
            : $this->divisions->flatMap(fn($division) => $division->events)->sortByDesc('event_datetime');

        $filter = Session::get('cabinetNewsFilters', collect());

        if($filter->has('search'))
            $list= $list->filter(fn($item)  =>
                $item->id == $filter->get('search') ||
                Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->title))
            );

        if($filter->has('author'))
            $list= $list->filter(fn($item)  => $item->author_id == $filter->get('author'));

        if($filter->has('division'))
            $list= $list->filter(fn($item)  =>
                $item->relation_id == $filter->get('division') && $item->relation_type == Division::class
            );

        $list = $list->paginate($this->perPage);

        $byFilter = collect([
            'divisions' => flattenTreeForSelect($this->allDivisions, $this->ids->toArray()),
            'authors' => $this->accessUsers->pluck('name', 'id')
        ]);

        $list= $list->where(fn($item)  => !$item->has_approval || !$item->is_show)->paginate($this->perPage);

        $request->session()->put('cabinet-events-route', Route::current()->uri());

        return view('events.cabinet.list', compact('list', 'byFilter'));
    }


    public function setFilter(Request $request): RedirectResponse
    {
        if($request->has('clear'))
            Session::remove('cabinetNewsFilters');
        else
            Session::put('cabinetNewsFilters', $request->collect()->filter(fn($item) => !empty($item)));

        return redirect()->back();
    }

    public function form(Events $event): View
    {

        $divisions  = flattenTreeForSelect($this->allDivisions, $this->ids->toArray());

        $categories = EventCategories::all()->pluck('name', 'id');

        return view('events.cabinet.form', compact('event', 'divisions', 'categories'));
    }

    public function save(Request $request, Events $event): RedirectResponse
    {
        $form = $request->validate($event->validateRules(), $event->validateMessages());

        $event->fill($form)->save();

        if(!$event->exists || !$event->author)
            $event->author()->associate(auth()->user())->save();


        if($request->filled('content'))
            $event->getContentRecord()->fill(['content'=> $request->get('content')])->save();

        if($request->filled('short'))
            $event->getShortRecord()->fill(['content'=> $request->get('short')])->save();

        if($request->input('division')){
            $division = Division::find($request->input('division'));

            $event->fill($form)->relation()->associate($division)->save();
        }

        if($request->file('image')){
            $event->image->saveImageAndPath($request->file('image'));
            $event->preview->saveImageAndPath($request->file('image'), 300, 300);
        }

        return redirect()->to( $request->has('save-close') ? $request->session()->get('cabinet-events-route') : $event->cabinet_form_link);
    }

    public function delete(Request $request, Events $event): RedirectResponse
    {
        $event->delete();
        return redirect()->to($request->session()->get('cabinet-events-route') ?? $event->cabinet_list_link);
    }
}
