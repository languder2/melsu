<?php

namespace App\Http\Controllers\Education;

use App\Enums\ProfileDocumentType;
use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function modalDocument(Profile $profile, ?Document $document): View
    {
        $code = request()->get('code');

        $case = ProfileDocumentType::getByCode($code);

        $type = $case->name;

        return view('components.info.education.modal', compact('profile', 'document', 'code','type'));
    }
    public function saveDocument(Request $request, Profile $profile, ?Document $document): RedirectResponse
    {
        $document->relation()->associate($profile);

        $options = collect($request->get('optional'));

        if($options->get('type')){
            $type = ProfileDocumentType::getByName($options->get('type'));

            if($type->code())
                $options->put('code', $type->code());
        }

        $form = [
            'title' => $request->get('title') ?? $type->label()." ".$options->get('year'),
            'file' => $request->file('file'),
            'sort' => $request->get('sort'),
        ];

        if($request->file('file'))
            Document::FileSave($form, $profile);

        $document->fill($form)->relation()->associate($profile)->save();

        foreach ($options as $code=>$value)
            if($value)
                $document->getOption($code)->fill(['property' => $value])->save();
            else
                $document->getOption($code)->delete();

        return redirect()->back();
    }
    public function modalNir(Profile $profile): View
    {
        $info   = (object)[
            'perechenNir'       => $profile->getInfoByCode('perechenNir')->content,
            'napravNir'         => $profile->getInfoByCode('napravNir')->content,
            'resultNir'         => $profile->getInfoByCode('resultNir')->content,
            'baseNir'           => $profile->getInfoByCode('baseNir')->content,
        ];

        return view('components.info.education.modal-nir', compact('profile','info'));
    }
    public function saveNir(Request $request, Profile $profile): RedirectResponse
    {

        foreach ($request->get('info') as $code=>$value)
            $profile->getInfoByCode($code)->fill(['type'=>'education', 'code' => $code, 'content' => $value])->save();

        return redirect()->back();
    }

    public function modalJob(Speciality $item): View
    {
        $info   = (object)[
            'v1'        => $item->getInfoByCode('v1')->content,
            't1'        => $item->getInfoByCode('t1')->content,
        ];

        return view('components.info.education.modal-job', compact('item','info'));
    }
    public function saveJob(Request $request, Speciality $item): RedirectResponse
    {

        foreach ($request->get('info') as $code=>$value)
            $item->getInfoByCode($code)->fill(['type'=>'education', 'code' => $code, 'content' => $value])->save();

        return redirect()->back();
    }

}
