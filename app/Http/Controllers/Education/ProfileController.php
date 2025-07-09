<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Education\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function saveDocument(Request $request, Profile $profile, ?Document $document): RedirectResponse
    {
        $document->relation()->associate($profile);

        $form = ['title' => $request->get('title'), 'file' => $request->file('file')];

        Document::FileSave($form, $profile);

        $document->fill($form)->relation()->associate($profile)->save();

        foreach ($request->get('optional') as $code=>$value)
            if($value)
                $document->getOption($code)->fill(['property' => $value])->save();
            else
                $document->getOption($code)->delete();

        return redirect()->back();
    }
    public function modalDocument(Profile $profile, ?Document $document): View
    {
        $code = request()->get('code');

        return view('components.info.education.modal', compact('profile', 'document', 'code'));
    }

}
