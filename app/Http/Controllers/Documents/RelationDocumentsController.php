<?php

namespace App\Http\Controllers\Documents;

use App\Enums\Entities;
use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RelationDocumentsController extends Controller
{

    public function form($entity, $entity_id, DocumentCategory $category, Document $document): View|RedirectResponse
    {
        $instance = Entities::instance($entity, $entity_id);

        dd(123);
    }

}
