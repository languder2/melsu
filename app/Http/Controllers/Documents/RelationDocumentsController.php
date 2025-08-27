<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Education\Speciality;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RelationDocumentsController extends Controller
{

//    protected function getModel($model, $id): ?Model
//    {
//        return match($model) {
//            'page'          => Page::find($id),
//            'division'      => Division::find($id),
//            'speciality'    => Speciality::find($id),
//            default         => null
//        };
//    }
//
//    public function admin(string $model, int $id):View
//    {
//        $entity = $this->getModel($model, $id);
//
//        if(!$entity)
//            abort(404);
//
//        dd($entity);
//
//        return view('divisions.documents.admin');
//    }

    public function show($item){
        dd(123);
    }
    public function edit(?Document $photo){
        dd($photo);
    }
    public function create(?Document $document){
        dd($document);
    }
}
