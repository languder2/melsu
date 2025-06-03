<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Gallery\Gallery;
use Illuminate\View\View;

class AdminImageGallery extends Controller
{
    public function ApiToggleShow (Request $request,$id): JsonResponse
    {

        $gallery = Gallery::Find($id);

        if(!$gallery)
            return response()->json([],204);

        $gallery->show = $gallery->show?'':true;
        $gallery->save();

        return response()->json(
            [
                'message' => ($gallery->show?"Галерея опубликована":'Галерея скрыта')."\n{$gallery->name}"
            ]);
    }
    public function ApiDelete (Request $request,$id): JsonResponse
    {

        $gallery = Gallery::Find($id);

        if(!$gallery)
            return response()->json([],204);

        $gallery->delete();

        return response()->json(
            [
                'message' => "Галерея удалена\n{$gallery->name}\n Восстановимо до: "
                    .Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
    }

}
