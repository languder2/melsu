<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Page\Content;
use App\Models\Sections\Contact;
use App\Models\Staff\Affiliation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ControlController extends Controller
{
    public function sections():View
    {
        $list = Content::where('show',true)->where('show_title',true)->orderBy('title')->get()->groupBy('title');
        return view('services.control.sections', compact('list'));
    }
    public function contacts():View
    {
        $list = Contact::where('is_show',true)->whereNotNull('title')->orderBy('title')->get()->groupBy('title');
        return view('services.control.sections', compact('list'));
    }
    public function staffs():View
    {



        $list = Affiliation::where('show',true)->whereNotNull('staff_id')->orderBy('full_name')->get()
            ->mapWithKeys(fn ($item) => [
                $item->id => (object)[
                    'id'            => $item->id,
                    'staff_id'      => $item->staff_id,
                    'full_name'     => $item->card->full_name ?? null,
                    'post'          => $item->post,
                    'post_full'     => $item->post_alt,
                    'division'      => $item->relation->name ?? null,
                ]
            ])
            ->groupBy(function ($item) {
                return strtoupper(mb_substr($item->full_name, 0, 1, 'UTF-8'));
            })
            ->sortKeys();

        return view('services.control.staffs', compact('list'));
    }
}
