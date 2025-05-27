<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Enums\DurationType;
use App\Enums\EducationBasis;
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

class SpecialityController extends Controller
{
    public function list(): View
    {
        $list   = Division::where('type',DivisionType::Faculty)->orderBy('name')->get();
        $spo    = Speciality::where('level',EducationLevel::Colleges)->orderBy('name')->get();

        return view('specialities.admin.list', compact('list','spo'));
    }

    public function form($id = null)
    {

        $current        = Speciality::find($id) ?? new Speciality();

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

        $record->show = (int)array_key_exists('show', $form);

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
//        $item = Speciality::where('show',true)->first();
//
//        $profile= $item->publicProfiles->first();
//
//        dump($item);
//        dump($item->publicProfiles);
//
//        dump($profile->placesByType(EducationBasis::Budget));
//        dump($profile->placesByType(EducationBasis::Contract));
//
//        dump($profile->durationYear(DurationType::OOO));
//        dump($profile->durationMonth(DurationType::OOO));
//
//        dump($profile->durationYear(DurationType::SOO));
//        dump($profile->durationMonth(DurationType::SOO));

        $list = Speciality::where('show',true)->get()
            ->mapWithKeys(function ($record) {
                return [$record->id =>
                    (object)[
                        "id"                => $record->id ?? null,
                        "spec_code"         => $record->spec_code ?? null,
                        "name"              => $record->name ?? null,
                        "department_id"     => $record->department_id ?? null,
                        "department_name"   => $record->department->name ?? null,
                        "faculty_id"        => $record->faculty_id ?? null,
                        "faculty_acronym"   => $record->faculty->acronym ?? null,
                        "faculty_name"      => $record->faculty->name ?? null,
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

}
