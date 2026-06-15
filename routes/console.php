<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Education\Profile;

Schedule::call(function () {
    Cache::forget('sveden_education_list_1');

    Cache::rememberForever('sveden_education_list_1', function () {
        return Profile::with([
            'speciality',
            'speciality.level',
            'getDocuments',
            'getDocuments.options'
        ])
            ->whereHas('speciality')
            ->public()
            ->get()
            ->map(function ($profile) {
                $eduPredDocs = $profile->getDocuments->filter(function ($doc) {
                    return $doc->options->contains('property', 'eduPred');
                })->map(fn($doc) => ['link' => $doc->link, 'title' => $doc->title])->values()->all();

                $eduPracDocs = $profile->getDocuments->filter(function ($doc) {
                    return $doc->options->contains('property', 'eduPrac');
                })->map(fn($doc) => ['link' => $doc->link, 'title' => $doc->title])->values()->all();

                return [
                    'spec_code'         => $profile->speciality->spec_code,
                    'spec_name'         => $profile->speciality->name,
                    'spec_profile'      => $profile->speciality->name_profile,
                    'level_alt_name'    => $profile->speciality->level?->getAltName() ?? '',
                    'form_name'         => $profile->form?->getName() ?? '',
                    'duration'          => $profile->formatedDuration(),
                    'eduPredDocs'       => $eduPredDocs,
                    'eduPracDocs'       => $eduPracDocs,
                ];
            })
            ->all();
    });

    Cache::forget('sveden_education_list_2');

    Cache::rememberForever('sveden_education_list_2', function () {
        return Profile::with([
            'speciality',
            'getDocuments',
            'getDocuments.options'
        ])
            ->whereHas('speciality')
            ->public()
            ->get()
            ->map(function ($profile) {
                return [
                    'spec_code'             => $profile->speciality->spec_code,
                    'spec_name'             => $profile->speciality->name,
                    'spec_profile'          => $profile->speciality->name_profile,
                    'level_alt_name'        => $profile->speciality->level?->getAltName() ?? '',
                    'form_name'             => $profile->form?->getName() ?? '',
                    'duration'              => $profile->formatedDuration(),
                    'opMain'                => $profile->documentsWithOptionValue('opMain'),
                    'educationPlan'         => $profile->documentsWithOptionValue('educationPlan'),
                    'educationRpd'          => $profile->documentsWithOptionValue('educationRpd'),
                    'educationShedule'      => $profile->documentsWithOptionValue('educationShedule'),
                    'eduPr'                 => $profile->documentsWithOptionValue('eduPr'),
                    'methodology'           => $profile->documentsWithOptionValue('methodology'),
                ];
            })
            ->all();
    });

})->hourly();
