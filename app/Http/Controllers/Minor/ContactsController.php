<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Minor\Career;
use App\Models\Minor\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactsController extends Controller
{
    public function list(string $entity, int $entity_id, bool $onApproval = false): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        $list       = $instance->contacts->sortBy('type')->groupBy('type');

        return view('contacts.cabinet.list', compact('list', 'instance'));
    }

    public function form(string $entity, int $entity_id, Contact $contact): View
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$contact->exists)
            $contact->relation()->associate($instance);

        return view('contacts.cabinet.form', compact('contact', 'instance', 'entity'));
    }

    public function save(Request $request, string $entity, int $entity_id, Contact $contact): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if(!$contact->exists)
            $contact->relation()->associate($instance);

        $form = $request->validate($contact->validateRules(), $contact->validateMessages());

        $contact->fill($form)->save();

        return redirect()->to(
            $request->has('save-close')
                ? $instance->contacts_cabinet_list
                : $contact->cabinet_form
        );
    }

    public function delete(string $entity, int $entity_id, Contact $contact): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        if($instance == $contact->relation)
            $contact->delete();

        return redirect()->back();
    }

    public function changeSort(string $entity, int $entity_id, Contact $contact, $direction): RedirectResponse
    {
        $instance   = Entities::instance($entity, $entity_id);

        flipSort($instance->contactsByType($contact->type)->orderBy('sort','desc')->get(), $contact, $direction);

        return redirect()->back();
    }

}
