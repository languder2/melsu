<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Enums\EducationLevel;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Menu\Menu;
use App\Models\Page\Content as PageContent;
use App\Models\Sections\Career;
use App\Models\Sections\FAQ;
use App\Models\Services\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use App\View\Components\Specialities\Admin\Filters as AdminFilter;
class SpecialityController extends Controller
{
    public function admin(): View
    {
        $list   = Speciality::orderByRaw(EducationLevel::getOrder())->orderBy('spec_code')->orderBy('name');

        if(session()->has('specialities:admin:filters')){

            $filters = session()->get('specialities:admin:filters');


            if($filters['level'])
                $list = $list->where('level', $filters['level']);

            if($filters['is_show'])
                $list = $list->where('show', $filters['is_show']==='true');

            if($filters['institute'])
                $list = $list->where('institute_id', $filters['institute']);

            if($filters['faculty'])
                $list = $list->where('faculty_id', $filters['faculty']);

            if($filters['department'])
                $list = $list->where('department_id', $filters['department']);

            if($filters['branch'])
                $list = $list->where('relation_id', $filters['branch']);

            if($filters['search'])
                $list->where(function ($query) use ($filters) {
                    $query
                        ->where('id', $filters['search'])
                        ->orWhere('name', 'like', '%'.$filters['search'].'%')
                        ->orwhere('name_profile', 'like', '%'.$filters['search'].'%')
                        ->orWhere('spec_code', 'like', '%'.$filters['search'].'%');
                });

        }

        $list   = $list->get();

        return view('specialities.admin.list', compact('list'));
    }

    public function setFilter(Request $request):RedirectResponse
    {

        if($request->has('clear'))
            session()->forget('specialities:admin:filters');
        else
            session()->put('specialities:admin:filters',$request->validate(AdminFilter::rules()));

        return redirect()->back();
    }

    public function form(?Speciality $current)
    {

        $faculties      = Division::where('type',DivisionType::Faculty)
                            ->orderBy('name')
                            ->get()
                            ->pluck('name', 'id');

        $departments    = Division::where('type',DivisionType::Department)
                            ->orderBy('alt_name')
                            ->get()
                            ->pluck('alt_name', 'id');

        $branches       = Division::where('type',DivisionType::Branch)
                            ->orderBy('name')
                            ->get()
                            ->pluck('name', 'id');

        return view('specialities.admin.form',
            compact('current','faculties','departments','branches')
        );
    }

    public function save(Request $request, ?Speciality $current):RedirectResponse
    {

        $form = $request->validate(Speciality::FormRules($request->get('id')),Speciality::FormMessage());

        $record = Speciality::find($request->get('id')) ?? new Speciality();

        $record->fill($form);

        $record->save();

        Log::add($record);

        if($request->has('branch_id')){
            $branch = Division::find($request->get('branch_id'));

            if($branch)
                $record->relation()->associate($branch)->save();
        }

        if($request->has('ico')){
            $ico = $record->ico ?? ( new Image(['type'=>'ico','name'=>$record->name]))->relation()->associate($record);
            $ico->saveImage($request->file('ico'));
        }

        if($request->has('sections'))
            PageContent::processing($record,$request->get('sections'));

        if($request->has('profiles'))
            Profile::processing($record,$request->get('profiles'));

        if($request->has('faq'))
            FAQ::processing($record,$request->get('faq'));

        if($request->has('career'))
            Career::processing($record,$request->get('career'));


        if($request->has('documents'))
            Document::processingForms($record,$request->get('documents'),$record);

        $current->postSaveMaintenance();

        if($request->has('save'))
            return redirect()->to($current->form);
        else
            return redirect()->to($current->admin);
    }

    public function delete(?Speciality $speciality)
    {
        $speciality->delete();

        Log::add($speciality,'delete');

        return redirect()->route('admin:speciality:list');
    }

    public function showAll()
    {
        $menu= Menu::where('code','education')->first();

        return view('public.education.speciality.all',compact('menu'));
    }

    public function showSingle(Speciality $speciality)
    {
        if (!$speciality)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::where('code','education')->first();

        return view('public.education.speciality.single',compact('speciality','menu'));
    }

    /* API */

    public function getListAPI():Collection
    {


        $list = Speciality::where('show',true)->where('is_recruitment',true)
            ->orderByRaw(EducationLevel::getOrder())->orderBy('spec_code')->orderBy('name')
            ->get()
            ->mapWithKeys(function ($record) {
                return [$record->id =>
                    (object)[
                        "id"                => $record->id ?? null,
                        "spec_code"         => $record->spec_code ?? null,
                        "name"              => $record->name.($record->name_profile ? " ({$record->name_profile})" : ''),
                        "department_id"     => $record->department_id ?? null,
                        "department_name"   => $record->department->name ?? null,
                        "faculty_id"        => $record->faculty_id ?? null,
                        "faculty_acronym"   => $record->faculty->acronym ?? null,
                        "faculty_name"      => $record->faculty->name ?? null,
                        "collage"           => $record->relation ? $record->relation->alt_name ?? $record->relation->name : null,
                        "level"             => $record->level->getName() ?? null,
                        "forms"             => $record->publicProfiles->mapWithKeys(function($profile){
                              return [
                                  $profile->form->value =>
                                      (object)[
                                          'name'        => $profile->form->getName(),
                                          "prices"      => $profile->price,
                                          'places'      => [
                                              $profile->places->mapWithKeys(function($place){
                                                  return [$place->type => $place->count];
                                              })->toArray() ?? null
                                          ],
                                          'duration'      => [
                                              $profile->duration->mapWithKeys(function($duration){
                                                  return [$duration->type => $duration->DurationString];
                                              })->toArray() ?? null
                                          ],
                                      ]
                              ];
                            })->toArray() ?? null,
                    ]
                ];
            });
        return $list;
    }

    public function educationProgramsHigherEducation():View
    {
        $specialities = Speciality::
            whereIn('level',[EducationLevel::Bachelor,EducationLevel::Master,EducationLevel::Specialist])
            ->where('show',true)
            ->orderByraw(EducationLevel::getOrder())
            ->orderBy('spec_code')
            ->orderBy('name')
            ->get();

        return view('specialities.public.education-programs-higher-education', compact('specialities'));
    }


    public function adminEducationPrograms(Request $request):View
    {
        $filters = $request->all();

        $specialities = Speciality::orderBy('spec_code')->orderBy('name');

        if($request->get('show'))
            $specialities->where('show',$filters['show'] === 'show');

        if($request->get('level'))
            $specialities->where('level',$filters['level']);

        if($request->get('search'))
            $specialities->where(function ($query) use ($filters) {
                $query->where('name', 'like', '%'.$filters['search'].'%')
                    ->orWhere('spec_code', 'like', '%'.$filters['search'].'%');
            });

        if($request->get('is_recruitment'))
            $specialities->where('is_recruitment',$filters['is_recruitment'] === 'true');

        $specialities   = $specialities->get();

        return view('specialities.admin.specialities', compact('specialities','filters'));
    }

}
