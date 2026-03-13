<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Events\Category;
use App\Models\Events\Events;
use App\Models\News\News;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Kalnoy\Nestedset\QueryBuilder;

class CabinetEventsController extends Controller
{
    protected int $perPage = 50;
    public function list(bool $onApproval = false): View
    {

        $divisions = Division::listBasedOnAuthUser();

        $query = Events::orderBy('event_datetime', 'desc');

        if(!auth()->user()->isEditor())
            $query->forRelations($divisions->pluck('id'), Division::class);

        $list = $query->get();

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

        if($onApproval)
            $list = $list->filter(fn($item) => !$item->has_approval);

        $list = $list->paginate($this->perPage);

        $byFilter = collect([
            'divisions' => $divisions->get()->pluck('nameWithPrefixLevel','id'),
            'authors'   =>
                $divisions->get()
                    ->flatMap(fn($division) => $division->events)
                    ->unique('author_id')
                    ->map(fn($item) => $item->author)
                    ->pluck('name','id')
        ]);

        session()->put('cabinet-events-route', Route::current()->uri());

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

        $dQuery =  Division::listBasedOnAuthUser();

        $divisions = $dQuery->get()->pluck('nameWithPrefixLevel','id');

        $divisionsDiff = $event->divisions->diff($dQuery->get())->pluck('nameWithPrefixLevel','id');

        $categories = Category::all()->pluck('name', 'id');

        return view('events.cabinet.form', compact('event', 'divisions', 'divisionsDiff', 'categories'));
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

        if($request->input('divisions'))
            $event->divisions()->sync(
                collect(json_decode($request->input('divisions')))
            );

        if($request->input('categories'))
            $event->categories()->sync(
                collect(json_decode($request->input('categories')))
            );

        if($request->file('image'))
            $event->preview->saveImage($request->file('image'));

        return redirect()->to( $request->has('save-close') ? $request->session()->get('cabinet-events-route') : $event->cabinet_form_link);
    }

    public function delete(Request $request, Events $event): RedirectResponse
    {
        $event->delete();
        return redirect()->to($request->session()->get('cabinet-events-route') ?? $event->cabinet_list_link);
    }
}
