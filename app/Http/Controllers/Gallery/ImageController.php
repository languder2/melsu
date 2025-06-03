<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageController extends Controller
{
    public function ApiToggleShow (?Image $image): JsonResponse
    {

        if(!$image->exists)
            return response()->json([],204);

        $image->fill([
            'show' => $image->show ? '' : 1,
        ])->save();

        return response()->json(
            [
                'message' => ($image->show ? "Фотография опубликована":'Фотография скрыта')."\n#{$image->id} {$image->name}"
            ]);
    }
    public function ApiDelete (?Image $image): JsonResponse
    {
        $image->delete();

        return response()->json(
            [
                'message' => "Фотография удалена\n{$image->name}\n Восстановимо до: "
                    .Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
    }
}


