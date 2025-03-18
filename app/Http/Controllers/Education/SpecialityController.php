<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Department;
use App\Models\Education\Level;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Menu\Menu;
use App\Models\Page\Content as PageContent;
use App\View\Components\Specialities\Single as SingleSpeciality;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SpecialityController extends Controller
{
    public function list(): string
    {
        $list   = Division::where('type',DivisionType::Faculty)->orderBy('name')->get();
        $spo    = Speciality::whereNull('faculty_id')->orderBy('name')->get();

        return view('admin.education.specialities.list', compact('list','spo'));
    }

    public function form(Request $request, $id = null)
    {
        $current        = Speciality::find($id);
        $faculties      = Division::where('type',DivisionType::Faculty)
                            ->orderBy('name')
                            ->get()
                            ->pluck('name', 'id');
        $departments    = Division::where('type',DivisionType::Department)
            ->orderBy('alt_name')->get()->pluck('alt_name', 'id');

        return view('admin.education.specialities.form',
            compact('current','faculties','departments','levels')
        );
    }

    public function save(Request $request)
    {

        $form = $request->validate(Speciality::FormRules($request->get('id')),Speciality::FormMessage());

        $record = Speciality::find($request->get('id'));

        if(!$record)
            $record = new Speciality();

        $record->fill($form);

        $record->show = array_key_exists('show', $form);

        $record->save();

        if($request->has('ico')){
            $ico = $record->ico ?? ( new Image(['type'=>'ico','name'=>$record->name]))->relation()->associate($record);
            $ico->saveImage($request->file('ico'));
        }

        if($request->has('sections'))
            PageContent::processing($record,$request->get('sections'));

        if($request->has('profiles'))
            foreach ($request->get('profiles') as $profileForm) {

                $profile = Profile::where([
                    'speciality_code' => $record->code,
                    'form_code' => $profileForm['form_code'],
                ])->first();

                if (!$profile)
                    $profile = new Profile([
                        'speciality_code' => $record->code,
                        'form_code' => $profileForm['form_code'],
                        'alias' => "{$record->code}-{$profileForm['form_code']}",
                    ]);

                $profileForm['show'] = isset($profileForm['show']);

                $profileForm['afc'] = isset($profileForm['afc']);

                $profile->fill($profileForm);

                $profile->save();

                foreach ($profileForm['places'] as $type => $count) {
                    $place = $profile->places->where('type', $type)->first();

                    if (!$place)
                        $place = $profile->places()->create(['type' => $type]);

                    $place->count = $count;
                    $place->save();
                }

                foreach ($profileForm['exams'] as $type => $list) {
                    foreach ($list as $subject_id => $item) {
                        $exam = $profile->exams()->where([
                            'type' => $type,
                            'subject_id' => $subject_id,
                        ])->first();

                        if (!$exam)
                            $exam = $profile->exams()->create([
                                'type' => $type,
                                'subject_id' => $subject_id,
                            ]);

                        if (!isset($item['required']))
                            $item['required'] = false;

                        if (!isset($item['selectable']) || $item['required'])
                            $item['selectable'] = false;

                        $exam->fill($item);
                        $exam->save();

                    }
                }
            }

        return redirect()->route('admin:speciality:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:speciality:list');
    }

    public function showAll()
    {
        $menu= Menu::where('code','education')->first();

        return view('public.education.speciality.all',compact('menu'));
    }

    public function showSingle(?string $speciality_code): string|RedirectResponse
    {

        $speciality = Speciality::where('code', $speciality_code)->first();

        if (!$speciality)
            return redirect()->to(route('public:education:faculties'));

        return view("pages.page", [
            'sidebar' => View::make('components.menu.sidebar')->with([
                'menu' => &$menu,
                'full' => false,
            ])->render(),

            'nobg' => true,

            'contents' => [
                (new SingleSpeciality($speciality))->render(),
            ]

        ]);
    }

}
