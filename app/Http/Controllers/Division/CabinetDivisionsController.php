<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Users\User;
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
        $this->divisions = auth()->user()->isEditor() ? Division::fullTree()
            : auth()->user()->divisions->flatMap(fn($item) => $item->getFlattenTree(true))->keyBy('id');
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

    public function form(?Division $division): View
    {
        $divisions = flattenTree($this->divisions)->keyBy('id')
            ->map(
                fn ($item) =>
                    str_repeat('&nbsp;', $item->level*3)
                    . ($item->level ? __('common.arrowT2R')  : '' )
                    . $item->name
            );

        $types = DivisionType::labels();

        if(!$division->content && $division->sections->count()){

            $data = (object)['blocks' => []];

            $division->sections->filter(fn($item) => $item->show)->each(function($item) use (&$data){
                $data->blocks[] = (object)[
                    'type' => 'code',
                    'data' => (object)[
                        'code' => ( $item->show_title ? "<h4>$item->title</h4>" : '' ) . $item->content,
                    ]
                ];
            });

            $division->getContentRecord()->fill(['content' => json_encode($data)])->save();
        }


        return view('divisions.cabinet.form', compact('division', 'divisions', 'types'));
    }


    public function save(Request $request, ?Division $division): RedirectResponse
    {

        $form = $request->validate($division->validateRules(), $division->validateMessage());

        $division->fill($form)->save();

        $division->getContentRecord()->fill(['content' => $request->get('content')])->save();

        if($request->get('meta'))
            $division->metaSave($request->get('meta'), $request->file('meta.image'));

        return redirect()->to( $request->has('save-close') ? $division->cabinet_list : $division->cabinet_form);
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

}
