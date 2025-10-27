<?php

namespace App\Http\Controllers\Partners;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Partners\Partner;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function list($entity = null, $entity_id = null): View
    {
        $instance   = Entities::instance($entity, $entity_id);
        $entity     = Entities::tryFrom($entity);

        if($instance)
            $list = $instance->partners;
        else
            $list = Partner::all();

        $title = collect([
            __('admin.Admin panel'),
            $instance ? $instance->name : null,
            __('partners.Partners'),
        ])
            ->filter(fn($item) => $item)
            ->implode(__('common.arrowR'));

        return view('partners.admin.list', compact('list', 'title', 'entity', 'instance') );
    }

    public function form(?Partner $partner, $entity = null,  $entity_id = null): View
    {
        $instance   = Entities::instance($entity, $entity_id);
        $entity     = Entities::tryFrom($entity);

        $title = collect([
            __('admin.Admin panel'),
            $instance ? $instance->name : null,
            __('partners.Partners'),
        ])
            ->filter(fn($item) => $item)
            ->implode(__('common.arrowR'));

        return view('partners.admin.form', compact('title', 'entity', 'instance', 'partner') );
    }
}
