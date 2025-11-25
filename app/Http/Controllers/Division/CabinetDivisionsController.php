<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CabinetDivisionsController extends Controller
{
    protected Collection $divisions;
    public function __construct(){

        $this->divisions = Division::fullTree();

        if(!auth()->user()->isEditor()){
            $ids = auth()->user()->divisions->pluck('id')->unique()->toArray();
            $this->divisions = $this->divisions->filter(fn($item) => in_array($item->id, $ids));
        }
    }

    public function list(): View
    {
        $list = $this->divisions;

        $filter = Session::get('divisionCabinetFilter');

        if($filter && $filter->has('search'))
            $list = $list->filter(fn($item) =>
                $item->id == $filter->get('search')
                || Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->name))
                || Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->code))
                || Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->acronym))
                || Str::is('*'.mb_strtolower($filter->get('search')).'*', mb_strtolower($item->alt_name))
            );

        return view('divisions.cabinet.list', compact('list'));
    }

    public function form(Division $division): View
    {
        $divisions = $this->divisions
            ->reject(fn($item) => $item->id === $division->id)
            ->pluck('nameWithLevel', 'id');

        $types = DivisionType::labels();

        return view('divisions.cabinet.form', compact('division', 'divisions', 'types'));
    }


    public function save(Request $request, Division $division): RedirectResponse
    {

        $form = $request->validate($division->validateRules(), $division->validateMessage());

        $division->fill($form)->save();

        $division->content()->fill(['content' => $request->get('content')])->save();

        if($request->file('image'))
            $division->image->saveImage($request->file('image'));

        if($request->get('meta'))
            $division->metaSave($request->get('meta'), $request->file('meta.image'));

        return redirect()->to(
            $request->has('save-close')
                ? $division->cabinet_list
                : $division->cabinet_form
        );
    }

    public function setFilter(Request $request): RedirectResponse
    {
        if($request->has('clear'))
            Session::remove('divisionCabinetFilter');
        else{
            $filter = collect($request->all());
            Session::put('divisionCabinetFilter', $filter);
        }

        return redirect()->back();
    }

    public function historyForm(Division $division): view|RedirectResponse
    {
        $history = $division->content('history')->content;

        return view('divisions.cabinet.history-form', compact('division', 'history'));
    }

    public function historySave(Request $request, Division $division): view|RedirectResponse
    {
        $division->history->fill($request->all())->save();

        return redirect()->to( $request->has('save-close') ? $division->cabinet_list : $division->history_form);
    }

    public function achievementsForm(Division $division): view|RedirectResponse
    {
        $content = $division->content('achievements')->content;

        return view('divisions.cabinet.achievements-form', compact('division', 'content'));
    }

    public function achievementsSave(Request $request, Division $division): view|RedirectResponse
    {
        $division->content('achievements')->fill($request->all())->save();

        return $request->has('save-close') ? redirect()->to($division->cabinet_list) : redirect()->back();
    }

    public function galleryForm(Division $division): view|RedirectResponse
    {
        $content = $division->content('gallery')->content;

        return view('divisions.cabinet.gallery-form', compact('division', 'content'));
    }

    public function gallerySave(Request $request, Division $division): view|RedirectResponse
    {
        $division->content('gallery')->fill($request->all())->save();

        return $request->has('save-close') ? redirect()->to($division->cabinet_list) : redirect()->back();
    }

}
