<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Kalnoy\Nestedset\QueryBuilder;

class CabinetDivisionsController extends Controller
{


    protected QueryBuilder $query;
    protected array $allowedIDS = [];
    public function __construct(){
        $this->query = Division::defaultOrder()->withDepth();

        if(!auth()->user()->isEditor()){
            $this->allowedIDS = auth()->user()->divisions->pluck('id')->toArray();

            $this->query->whereIn('id', auth()->user()->divisions->pluck('id'));
        }

//        $this->query->where(function ($q) use ($allowedIds) {
//            foreach ($allowedIds as $id) {
//                $q->orWhere(fn($sub) => $sub->whereDescendantsAndSelf($id));
//            }
//        });

    }

    public function list(): View
    {
        $filter = Session::get('divisionCabinetFilter', collect());
        $search = $filter->get('search');

        $query = clone $this->query;

        if ($search) {
            $matchedNodes = (clone $query)->where(function($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('name', 'LIKE', "%$search%")
                    ->orWhere('code', 'LIKE', "%$search%")
                    ->orWhere('acronym', 'LIKE', "%$search%");
            })->get();

            if ($matchedNodes->isNotEmpty()) {
                $allIds = $matchedNodes->flatMap(function($node) {
                    return Division::descendantsAndSelf($node->id)->pluck('id');
                })->unique();

                $list = $query->whereIn('id', $allIds)->get()->unique('id');

            }
            else
                $list = collect();
        }
        else
            $list = $query->get()->unique('id');

        return view('divisions.cabinet.list', compact('list'));
    }
    public function form(Division $division): View
    {
        $divisions = $this->query->get()->unique('id')
            ->reject(fn($item) => $item->id === $division->id)
            ->pluck('nameWithPrefixLevel', 'id');

        $types = DivisionType::labels();

        return view('divisions.cabinet.form', compact('division', 'divisions', 'types'));
    }
    public function save(Request $request, Division $division): RedirectResponse
    {
        if(auth()->user()->isEditor()){
            $form = $request->validate($division->validateRules(), $division->validateMessage());

            $division->fill($form)->save();
        }

        $division->content()->fill(['content' => $request->get('content')])->save();

        $division->content('description')->fill(['content' => $request->get('description')])->save();

        if($request->file('image'))
            $division->image->saveImage($request->file('image'));

        if($request->file('compilation-image'))
            $division->image('compilation')->saveImage($request->file('compilation-image'));

        if($request->file('preview'))
            $division->image('preview')->saveImage($request->file('preview'));

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
        return view('divisions.cabinet.history-form', compact('division'));
    }

    public function historySave(Request $request, Division $division): view|RedirectResponse
    {
        $division->history->fill($request->all())->save();

        $division->option('has_history_in_moderation')
            ->fill(['property' => $request->input('is_approved')])
            ->save();

        return redirect()->to( $request->has('save-close') ? $division->cabinet_list : $division->history_form);
    }

    public function achievementsForm(Division $division): view|RedirectResponse
    {
        return view('divisions.cabinet.achievements-form', compact('division'));
    }

    public function achievementsSave(Request $request, Division $division): view|RedirectResponse
    {
        $division->content('achievements')->fill($request->all())->save();

        $division->option('has_achievements_in_moderation')
            ->fill(['property' => $request->input('is_approved')])
            ->save();

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

        $division->option('has_gallery_in_moderation')
            ->fill(['property' => $request->input('is_approved')])
            ->save();

        return $request->has('save-close') ? redirect()->to($division->cabinet_list) : redirect()->back();
    }

    public function statuses(): view|RedirectResponse
    {
        $list = $this->divisions
            ->filter(fn($item) => in_array($item->type, [DivisionType::Faculty,DivisionType::Department,DivisionType::Institute]))
            ->each(function ($item) {
                $item->hasBG                = $item->image->exists;
                $item->hasAbout             = $item->content('content')->exists ? mb_strlen(trim(strip_tags($item->content('content')->render()))) : 0;
                $item->hasHistory           = $item->content('history')->exists ? mb_strlen(trim(strip_tags($item->content('history')->render()))) : 0;
                $item->hasGallery           = $item->content('history')->exists ? strlen(trim(strip_tags($item->content('gallery')->render(), '<img>'))) : 0;
                $item->hasSpecialities      = $item->specialities->count();
                $item->countGoals           = $item->goals->count();
                $item->countCareers         = $item->careers->count();
                $item->countPartners        = $item->partners->count();
                $item->countPartnersLinks   = $item->partners->filter(fn($item) => $item->link)->count();
                $item->countPartnersLogo    = $item->partners->filter(fn($item) => $item->image->exists)->count();
                $item->countScience         = $item->science->count();
                $item->countGraduations     = $item->graduations->count();
            })
        ;

        return view('divisions.cabinet.statuses', compact('list'));
    }

    public function delete(Division $division): RedirectResponse
    {
        $division->subs->each(fn($item)=> $item->fill(['parent_id' => null])->save());

        $division->delete();

        return redirect()->back();
    }


}
