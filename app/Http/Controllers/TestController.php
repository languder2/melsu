<?php

namespace App\Http\Controllers;

use App\Models\Division\Division;
use App\Imports\Import;
use App\Models\Staff\Staff;
use App\Enums\DepartmentType;
use App\Models\Contact;
use App\Enums\ContactType;

class TestController extends Controller
{
    public function index()
    {
//
//        Contact::create([
//            'content'   => 'test',
//            'type'      => ContactType::Telegram
//
//        ]);
//
        $contacts = ContactType::getSortedCasesByName();

        dump($contacts);
    }
}
